<?php

namespace App\Exports;

use App\Models\HRD\Contract;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ContractsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            $types = $this->getTypesByCategory($this->filters['category']);
            $q->whereIn('type', $types);
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

        if (!empty($this->filters['start_date'])) {
            $q->whereDate('start_date', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $q->whereDate('start_date', '<=', $this->filters['end_date']);
        }

        return $q->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'No',
            'Contract Number',
            'Category',
            'Type',
            'Employee Name',
            'Employee Number',
            'Project',
            'Owner',
            'Title',
            'Start Date',
            'End Date',
            'Status',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        $statusMap = [
            'draft'       => 'Draft',
            'sent'        => 'Sent',
            'viewed'      => 'Viewed',
            'signed'      => 'Need Head HRD Approval',
            'signed-hrd'  => 'Need Head Approval',
            'signed-head' => 'Complete',
            'expired'     => 'Expired',
        ];

        return [
            $no,
            $row->contract_number,
            $row->category ?? '-',
            $row->type ?? '-',
            $row->user->name ?? '-',
            $row->user->employee_number ?? '-',
            $row->project->name ?? '-',
            $row->project->owner ?? '-',
            $row->title,
            $row->start_date?->format('d M Y') ?? '-',
            $row->end_date?->format('d M Y') ?? '-',
            $statusMap[$row->status] ?? ucfirst($row->status),
        ];
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

    private function getTypesByCategory(string $category): array
    {
        return match ($category) {
            'managerial'     => ['gp-um-ut-fungsi', 'gp-mahal-um-ut-fungsi', 'all-in'],
            'non-managerial' => ['security', 'ob', 'gp-um-ut-laut', 'gp-um-ut', 'gp-mahal-um-ut-fungsi-pls', 'gp-mahal-um-ut'],
            'project'        => ['pep-lokal-buny', 'elis-phkt-5-2', 'elis-phkt-6-1', 'eni-muara-bakau-lembur', 'eni-muara-bakau-all-in', 'ipfms-dobu'],
            default          => [],
        };
    }
}