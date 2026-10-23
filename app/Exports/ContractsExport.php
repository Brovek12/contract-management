<?php

namespace App\Exports;

use App\Models\HRD\Contract;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting; // TAMBAHKAN INI
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat; // TAMBAHKAN INI

class ContractsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $q = Contract::with(['user', 'project']);

        if (!empty($this->filters['category'])) {
            $q->where('category', $this->filters['category']);
        }

        if (!empty($this->filters['type'])) {
            $q->where('type', $this->filters['type']);
        }

        if (!empty($this->filters['project'])) {
            $q->whereHas('project', fn($x) => $x->where('name', $this->filters['project']));
        }

        if (!empty($this->filters['status'])) {
            $q->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['start_date_from'])) {
            $q->whereDate('start_date', '>=', $this->filters['start_date_from']);
        }

        if (!empty($this->filters['start_date_to'])) {
            $q->whereDate('start_date', '<=', $this->filters['start_date_to']);
        }

        if (!empty($this->filters['end_date_only'])) {
            $q->whereDate('end_date', '=', $this->filters['end_date_only']);
        }

        return $q->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        $headings = [
            'No',
            'Contract Number',
            'Category',
            'Type',
            'Employee Name',
            'Project',
            'Start Date',
            'End Date',
            'Status',
            'Gaji Pokok',
        ];

        $allowanceHeaders = [
            'Tunj. Projek',
            'Tunj. Kemahalan',
            'Uang Makan',
            'Uang Transport',
            'Tunj. Fungsional',
            'Insentif Security',
            'Shift Malam',
            'Tunj. Laut',
            'Tunj. Pulsa',
            'Uang Kehadiran',
            'Tunj. Jabatan',
            'Housing',
            'EWHC',
            'Daily Allowance',
            'Annual Leave',
            'Pesangon',
        ];

        return array_merge($headings, $allowanceHeaders);
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        $statusMap = [
            'draft'       => 'Draft',
            'sent'        => 'Sent',
            'viewed'      => 'Viewed',
            'signed'      => 'Need GM Approval',
            'signed-hrd'  => 'Ready to Send',
            'signed-head' => 'Complete',
            'stop'        => 'Stop',
            'expired'     => 'Expired',
        ];

        // PERBAIKAN: Kembalikan sebagai Float/Angka Murni, BUKAN String
        // Jika kosong atau 0, kembalikan null (agar Excel menampilkannya kosong, bukan 0 atau '-')
        $formatNumber = function ($value) {
            return ($value && $value > 0) ? (float) $value : null;
        };

        $data = [
            $no,
            $row->contract_number,
            $row->category ?? '-',
            $row->type ?? '-',
            $row->user->name ?? '-',
            $row->project->name ?? '-',
            $row->start_date?->format('d M Y') ?? '-',
            $row->end_date?->format('d M Y') ?? '-',
            $statusMap[$row->status] ?? ucfirst($row->status),
            $formatNumber($row->basic_salary), // Jadi Float
        ];

        $allowances = [
            $formatNumber($row->project_allowance),
            $formatNumber($row->cost_allowance),
            $formatNumber($row->meal_allowance),
            $formatNumber($row->transport_allowance),
            $formatNumber($row->functional_allowance),
            $formatNumber($row->security_incentive),
            $formatNumber($row->night_shift_allowance),
            $formatNumber($row->sea_allowance),
            $formatNumber($row->pulse_allowance),
            $formatNumber($row->attendance_allowance),
            $formatNumber($row->position_allowance),
            $formatNumber($row->housing_allowance),
            $formatNumber($row->ewhc_allowance),
            $formatNumber($row->daily_allowance),
            $formatNumber($row->annual_leave_allowance),
            $formatNumber($row->severance_allowance),
        ];

        return array_merge($data, $allowances);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '3699FF'],
                ],
            ],
        ];
    }

    // PERBAIKAN: Gunakan WithColumnFormatting untuk memformat angka secara otomatis
    public function columnFormats(): array
    {
        return [
            // Kolom J (10) adalah Gaji Pokok, sampai kolom Z (26) adalah Pesangon
            // Format: #,##0 artinya angka dengan pemisah ribuan (titik di Indonesia)
            'J' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'L' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'M' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'O' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'P' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'Q' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'R' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'S' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'T' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'U' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'V' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'W' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'X' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'Y' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'Z' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}