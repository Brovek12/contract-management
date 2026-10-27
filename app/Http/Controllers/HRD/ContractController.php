<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\HRD\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ContractsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ContractController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->hasPermissionTo('read-contracts')) {
            abort(403);
        }
        $data = Contract::with([
            'user',
            'project',
            'creator'
        ])
            ->latest()
            ->get();

        $employees = User::whereNotNull('employee_number')
            ->orderBy('name')
            ->get();

        $projects = Project::where('is_active', 1)
            ->orderBy('name')
            ->get();
        // dd($projects);

        return view('admin.hrd.contracts.index', compact(
            'data',
            'employees',
            'projects'
        ));
    }

   public function create(Request $request)
{
    $type     = $request->get('type');
    $category = $request->get('category');

    $typesByCategory = [
         'harian' => [
        'harian-biasa', // Sesuaikan dengan value option di form modal Anda
    ],
        'managerial' => [
            'gp-um-ut-fungsi',
            'gp-mahal-um-ut-fungsi',
            'all-in',
        ],
        'non-managerial' => [
            'security',
            'ob',
            'gp-um-ut-laut',
            'gp-um-ut',
            'gp-mahal-um-ut-fungsi',
            'gp-mahal-um-ut-fungsi-pls',
            'gp-mahal-um-ut',
        ],
        'project' => [

            // =====================
            // ENI
            // =====================
            'eni-civil-all-in',
            'eni-civil-reguler',
            'eni-smallcapital-all-in',
            'eni-smallcapital-reguler',
            'eni-muara-bakau-lembur',
            'eni-muara-bakau-all-in',

            // =====================
            // WARLOK / MEDCO
            // =====================
            'warlok-all-in',
            'warlok-lembur',
            'warlok-security',

            // =====================
            // ELIS PHKT
            // =====================
            'elis-phkt-5-2',
            'elis-phkt-6-1',

            // =====================
            // PHSS MAJOR
            // =====================
            'phss-major-ai-1',
            'phss-major-ai-2',
            'phss-major-ai-3',
            'phss-driver',
            'phss-humas',
            'phss-reguler',
            'phss-security',

            // =====================
            // SAND MONITORING
            // =====================
            'sandmon-teknisi-1',
            'sandmon-teknisi-2',

            // =====================
            // LAIN-LAIN
            // =====================
            'pep-lokal-buny',
            'sched-5-2',
            'lawe-lawe-reguler',
            'lawe-lawe-all-in',
            'ipfms-dobu',
            'ipfms-dobu-2',
        ],
    ];

    if (!array_key_exists($category, $typesByCategory)) {
        abort(403);
    }

    if (!in_array($type, $typesByCategory[$category])) {
        abort(403);
    }
     if ($category === 'harian') {
        $employees = User::whereNotNull('employee_number')->orderBy('name')->get();
        $projects = Project::where('is_active', 1)->orderBy('name')->get();
        $heads = User::whereNotNull('employee_number')->orderBy('name')->get();

        return view('admin.hrd.contracts.create-harian', compact(
            'employees',
            'projects',
            'heads',
            'type',
            'category'
        ));
    }

    $employees = User::whereNotNull('employee_number')
        ->orderBy('name')
        ->get();

    $projects = Project::where('is_active', 1)
        ->orderBy('name')
        ->get();

    $heads = User::whereNotNull('employee_number')
        ->orderBy('name')
        ->get();

    return view('admin.hrd.contracts.create', compact(
        'employees',
        'projects',
        'heads',
        'type',
        'category'
    ));
}

  public function store(Request $request)
{
    try {
        /*
        |--------------------------------------------------------------------------
        | 1. AMBIL CATEGORY & TYPE DARI REQUEST
        |--------------------------------------------------------------------------
        */
        $category = $request->input('category');
        $type     = $request->input('type');

        // Validasi Category & Type (opsional, pastikan sesuai dengan daftar Anda)
        $typesByCategory = [
            'harian' => ['harian-biasa'],
            'managerial' => ['gp-um-ut-fungsi', 'gp-mahal-um-ut-fungsi', 'all-in'],
            'non-managerial' => ['security', 'ob', 'gp-um-ut-laut', 'gp-um-ut', 'gp-mahal-um-ut-fungsi', 'gp-mahal-um-ut-fungsi-pls', 'gp-mahal-um-ut'],
            'project' => [
                'eni-civil-all-in', 'eni-civil-reguler', 'eni-smallcapital-all-in', 'eni-smallcapital-reguler', 'eni-muara-bakau-lembur', 'eni-muara-bakau-all-in',
                'warlok-all-in', 'warlok-lembur', 'warlok-security',
                'elis-phkt-5-2', 'elis-phkt-6-1',
                'phss-major-ai-1', 'phss-major-ai-2', 'phss-major-ai-3', 'phss-driver', 'phss-humas', 'phss-reguler', 'phss-security',
                'sandmon-teknisi-1', 'sandmon-teknisi-2',
                'pep-lokal-buny', 'sched-5-2', 'lawe-lawe-reguler', 'lawe-lawe-all-in', 'ipfms-dobu', 'ipfms-dobu-2',
            ],
        ];

        if (!array_key_exists($category, $typesByCategory) || !in_array($type, $typesByCategory[$category])) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. VALIDASI UMUM
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'contract_number' => 'required|string|max:255|unique:contracts,contract_number',
            'contract_date'   => 'required|date',
            'title'           => 'required|string|max:255',
            'user_id'         => 'required|exists:users,id',
            'employee_name'   => 'required|string|max:255',
            'department'      => 'nullable|string|max:255',
            'nik'             => 'nullable|string|max:50',
            'ktp_number'      => 'nullable|string|max:50',
            'birth_place'     => 'nullable|string|max:255',
            'birth_date'      => 'nullable|date',
            'age_at_contract' => 'nullable|integer|min:0|max:100',
            'gender'          => 'nullable|string|max:50',
            'address'         => 'nullable|string',
            'grade'           => 'nullable|string|max:50',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'project_id'      => 'nullable|exists:projects,id',
            'head_user_id'    => 'nullable|exists:users,id',
            'position'        => 'required|string|max:255',
            'work_location'   => 'required|string|max:255',
            'domicile'        => 'required|string|max:255',
            'basic_salary'    => 'required|numeric|min:0',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. VALIDASI TUNJANGAN SESUAI TYPE
        |--------------------------------------------------------------------------
        */
        $allowanceRules = $this->allowanceRulesByType($type);
        if (!empty($allowanceRules)) {
            $request->validate($allowanceRules);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. AMBIL NILAI TUNJANGAN
        |--------------------------------------------------------------------------
        */
        $allowances = [
            'project_allowance' => null, 'cost_allowance' => null, 'meal_allowance' => null, 
            'transport_allowance' => null, 'functional_allowance' => null, 'security_incentive' => null, 
            'night_shift_allowance' => null, 'sea_allowance' => null, 'pulse_allowance' => null, 
            'attendance_allowance' => null, 'position_allowance' => null, 'housing_allowance' => null, 
            'ewhc_allowance' => null, 'daily_allowance' => null, 'annual_leave_allowance' => null, 
            'severance_allowance' => null,
        ];

        foreach (array_keys($allowanceRules) as $field) {
            $allowances[$field] = $request->input($field, 0);
        }

        /*
        |--------------------------------------------------------------------------
        | 4.5 OVERWRITE KALKULASI OTOMATIS (SANDMON)
        |--------------------------------------------------------------------------
        */
        if (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2'])) {
            $basic     = (float) $request->basic_salary;
            $housing   = (float) $allowances['housing_allowance'];
            $transport = (float) $allowances['transport_allowance'];
            $thp       = $basic + $housing + $transport;

            $allowances['ewhc_allowance']         = round($thp * 0.65);
            $allowances['annual_leave_allowance'] = round($basic / 12);
        }

        /*
        |--------------------------------------------------------------------------
        | 4.6 PENYESUAIAN KHUSUS HARIAN
        |--------------------------------------------------------------------------
        */
        $workHours    = $request->input('work_hours', '8');
        $breakHours   = $request->input('break_hours', '1');
        $workDays     = $request->input('work_days', '6');
        $offDays      = $request->input('off_days', '1');
        $paymentDate  = $request->input('payment_date', '05');
        $department   = $request->department ?? ($category === 'harian' ? 'Harian' : null);

        /*
        |--------------------------------------------------------------------------
        | 5. SIMPAN CONTRACT
        |--------------------------------------------------------------------------
        */
        Contract::create([
            'contract_number' => $request->contract_number,
            'contract_date'   => $request->contract_date,
            'category'        => $category,
            'type'            => $type,
            'title'           => $request->title,

            'user_id'         => $request->user_id,
            'project_id'      => $request->project_id,
            'head_user_id'    => $request->head_user_id,

            'employee_name'   => $request->employee_name,
            'department'      => $department,
            'nik'             => $request->nik,
            'ktp_number'      => $request->ktp_number,
            'birth_place'     => $request->birth_place,
            'birth_date'      => $request->birth_date,
            'age_at_contract' => $request->age_at_contract,
            'gender'          => $request->gender,
            'address'         => $request->address,
            'grade'           => $request->grade,

            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,

            'position'        => $request->position,
            'work_location'   => $request->work_location,
            'domicile'        => $request->domicile,

            'basic_salary'    => $request->basic_salary,

            // KHUSUS HARIAN (5 Kolom Baru)
            'work_hours'      => $workHours,
            'break_hours'     => $breakHours,
            'work_days'       => $workDays,
            'off_days'        => $offDays,
            'payment_date'    => $paymentDate,

            // Allowances
            'project_allowance'      => $allowances['project_allowance'],
            'cost_allowance'         => $allowances['cost_allowance'],
            'meal_allowance'         => $allowances['meal_allowance'],
            'transport_allowance'    => $allowances['transport_allowance'],
            'functional_allowance'   => $allowances['functional_allowance'],
            'security_incentive'     => $allowances['security_incentive'],
            'night_shift_allowance'  => $allowances['night_shift_allowance'],
            'sea_allowance'          => $allowances['sea_allowance'],
            'pulse_allowance'        => $allowances['pulse_allowance'],
            'attendance_allowance'   => $allowances['attendance_allowance'],
            'position_allowance'     => $allowances['position_allowance'],
            'housing_allowance'      => $allowances['housing_allowance'],
            'ewhc_allowance'         => $allowances['ewhc_allowance'],
            'daily_allowance'        => $allowances['daily_allowance'],
            'annual_leave_allowance' => $allowances['annual_leave_allowance'],
            'severance_allowance'    => $allowances['severance_allowance'],

            'status'          => 'draft',
            'created_by'      => auth()->id(),
        ]);

        return redirect()
            ->route('contracts.index')
            ->with('OK', 'Contract Berhasil Dibuat');

    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('ERR', 'Gagal Membuat Contract: ' . $e->getMessage());
    }
}
    public function show(Contract $contract)
{
    $user = Auth::user();

    // =========================================================
    // GUARD — Employee
    // =========================================================
    if ($user->hasRole('Employee')) {

        // 1. Cek ownership
        if ($contract->user_id !== auth()->id()) {
            abort(403, 'Kontrak ini bukan milik Anda.');
        }

        // 2. Cek status — employee tidak boleh lihat draft & expired
        if (in_array($contract->status, ['draft', 'expired'])) {
            abort(403, 'Kontrak ini belum/tidak dapat diakses.');
        }
    }

    // =========================================================
    // LOAD RELATIONS
    // =========================================================
    $contract->load([
        'user',
        'project',
        'creator',
        'headUser',
    ]);

    // =========================================================
    // ROUTING VIEW — berdasarkan type & category
    // =========================================================

    if ($contract->type === 'harian-biasa' || $contract->category === 'harian') {
        return view('admin.hrd.contracts.show-harian', [
            'contract' => $contract,
            'type'     => $contract->type,
            'category' => $contract->category,
        ]);
    }

    // 1. Khusus IPFMS-DOBU (existing)
    if ($contract->type === 'ipfms-dobu' || $contract->type === 'ipfms-dobu-2') {
        return view('admin.hrd.contracts.show-dobu', [
            'contract' => $contract,
            'type'     => $contract->type,
            'category' => $contract->category,
        ]);
    }

    // 2. Khusus Sand Monitoring → view sandmon
    if (in_array($contract->type, ['sandmon-teknisi-1', 'sandmon-teknisi-2'])) {
        return view('admin.hrd.contracts.show-project-sandmon', [
            'contract' => $contract,
            'type'     => $contract->type,
            'category' => $contract->category,
        ]);
    }

    // 3. Category PROJECT → view project
    if ($contract->category === 'project') {
        return view('admin.hrd.contracts.show-project', [
            'contract' => $contract,
            'type'     => $contract->type,
            'category' => $contract->category,
        ]);
    }

    // 4. Managerial & Non-Managerial → view existing
    return view('admin.hrd.contracts.show', [
        'contract' => $contract,
        'type'     => $contract->type,
        'category' => $contract->category,
    ]);
}
public function edit(Contract $contract)
{
    $employees = User::whereNotNull('employee_number')
        ->orderBy('name')
        ->get();

    $projects = Project::where('is_active', 1)
        ->orderBy('name')
        ->get();

    $heads = User::whereNotNull('employee_number')
        ->orderBy('name')
        ->get();

    // Cek jika ini adalah kontrak harian
    if ($contract->type === 'harian-biasa' || $contract->category === 'harian') {
        return view('admin.hrd.contracts.edit-harian', compact(
            'contract',
            'employees',
            'projects',
            'heads'
        ));
    }

    // Default untuk Manajerial, Non-Manajerial, Project
    return view('admin.hrd.contracts.edit', compact(
        'contract',
        'employees',
        'projects',
        'heads'
    ));
}

 public function update(Request $request, Contract $contract)
{
    try {

        /*
        |--------------------------------------------------------------------------
        | 1. AMBIL TYPE & CATEGORY DARI CONTRACT (TIDAK BOLEH DIUBAH)
        |--------------------------------------------------------------------------
        */

        $type     = $contract->type;
        $category = $contract->category;


        /*
        |--------------------------------------------------------------------------
        | 2. VALIDASI UMUM
        |--------------------------------------------------------------------------
        */

        $request->validate([
            // Contract
            'contract_number' => 'required|string|max:255|unique:contracts,contract_number,' . $contract->id,
            'contract_date'   => 'required|date',
            'title'           => 'required|string|max:255',

            // Employee
            'user_id'         => 'required|exists:users,id',
            'employee_name'   => 'required|string|max:255',
            'department'      => 'nullable|string|max:255',
            'nik'             => 'nullable|string|max:50',
            'ktp_number'      => 'nullable|string|max:50',
            'birth_place'     => 'nullable|string|max:255',
            'birth_date'      => 'nullable|date',
            'age_at_contract' => 'nullable|integer|min:0|max:100',
            'gender'          => 'nullable|string|max:50',
            'address'         => 'nullable|string',
            'grade'           => 'nullable|string|max:50',

            // Period
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',

            // Placement
            'project_id'      => 'nullable|exists:projects,id',
            'head_user_id'    => 'nullable|exists:users,id',
            'position'        => 'required|string|max:255',
            'work_location'   => 'required|string|max:255',
            'domicile'        => 'required|string|max:255',

            // Salary
            'basic_salary'    => 'required|numeric|min:0',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. VALIDASI TUNJANGAN SESUAI TYPE
        |--------------------------------------------------------------------------
        */

        $allowanceRules = $this->allowanceRulesByType($type);

        if (!empty($allowanceRules)) {
            $request->validate($allowanceRules);
        }


        /*
        |--------------------------------------------------------------------------
        | 4. AMBIL NILAI TUNJANGAN (default 0 kalau tidak ada)
        |--------------------------------------------------------------------------
        */

        $allowances = [
            // Existing
            'project_allowance'      => null,
            'cost_allowance'         => null,
            'meal_allowance'         => null,
            'transport_allowance'    => null,
            'functional_allowance'   => null,
            'security_incentive'     => null,
            'night_shift_allowance'  => null,
            'sea_allowance'          => null,
            'pulse_allowance'        => null,
            'attendance_allowance'   => null,

            // NEW — Project
            'position_allowance'      => null,
            'housing_allowance'       => null,
            'ewhc_allowance'          => null,
            'daily_allowance'         => null,
            'annual_leave_allowance'  => null,
            'severance_allowance'     => null,
        ];

        foreach (array_keys($allowanceRules) as $field) {
            $allowances[$field] = $request->input($field, 0);
        }
        
        /*
        |--------------------------------------------------------------------------
        | 4.5 OVERWRITE KALKULASI OTOMATIS (SANDMON)
        |--------------------------------------------------------------------------
        */
        if (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2'])) {
            $basic     = (float) $request->basic_salary;
            $housing   = (float) $allowances['housing_allowance'];
            $transport = (float) $allowances['transport_allowance'];

            $thp = $basic + $housing + $transport;

            $allowances['ewhc_allowance']         = round($thp * 0.65);
            $allowances['annual_leave_allowance'] = round($basic / 12);
        }

        /*
        |--------------------------------------------------------------------------
        | 4.6 PENYESUAIAN KHUSUS HARIAN (Ambil dari request / gunakan nilai lama)
        |--------------------------------------------------------------------------
        */
        $workHours    = $request->input('work_hours', $contract->work_hours ?? '8');
        $breakHours   = $request->input('break_hours', $contract->break_hours ?? '1');
        $workDays     = $request->input('work_days', $contract->work_days ?? '6');
        $offDays      = $request->input('off_days', $contract->off_days ?? '1');
        $paymentDate  = $request->input('payment_date', $contract->payment_date ?? '05');


        /*
        |--------------------------------------------------------------------------
        | 5. UPDATE CONTRACT
        |--------------------------------------------------------------------------
        */

        $contract->update([

            // Contract information
            'contract_number' => $request->contract_number,
            'contract_date'   => $request->contract_date,
            'title'           => $request->title,

            // Relation
            'user_id'         => $request->user_id,
            'project_id'      => $request->project_id,
            'head_user_id'    => $request->head_user_id,

            // Employee snapshot
            'employee_name'   => $request->employee_name,
            'department'      => $request->department,
            'nik'             => $request->nik,
            'ktp_number'      => $request->ktp_number,
            'birth_place'     => $request->birth_place,
            'birth_date'      => $request->birth_date,
            'age_at_contract' => $request->age_at_contract,
            'gender'          => $request->gender,
            'address'         => $request->address,
            'grade'           => $request->grade,

            // Contract period
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,

            // Placement
            'position'        => $request->position,
            'work_location'   => $request->work_location,
            'domicile'        => $request->domicile,

            // Salary
            'basic_salary'    => $request->basic_salary,

            // KHUSUS HARIAN (5 Kolom Baru)
            'work_hours'      => $workHours,
            'break_hours'     => $breakHours,
            'work_days'       => $workDays,
            'off_days'        => $offDays,
            'payment_date'    => $paymentDate,

            // Allowances — EXISTING
            'project_allowance'      => $allowances['project_allowance'],
            'cost_allowance'         => $allowances['cost_allowance'],
            'meal_allowance'         => $allowances['meal_allowance'],
            'transport_allowance'    => $allowances['transport_allowance'],
            'functional_allowance'   => $allowances['functional_allowance'],
            'security_incentive'     => $allowances['security_incentive'],
            'night_shift_allowance'  => $allowances['night_shift_allowance'],
            'sea_allowance'          => $allowances['sea_allowance'],
            'pulse_allowance'        => $allowances['pulse_allowance'],
            'attendance_allowance'   => $allowances['attendance_allowance'],

            // Allowances — NEW (Project)
            'position_allowance'      => $allowances['position_allowance'],
            'housing_allowance'       => $allowances['housing_allowance'],
            'ewhc_allowance'          => $allowances['ewhc_allowance'],
            'daily_allowance'         => $allowances['daily_allowance'],
            'annual_leave_allowance'  => $allowances['annual_leave_allowance'],
            'severance_allowance'     => $allowances['severance_allowance'],
        ]);


        return redirect()
            ->route('contracts.index')
            ->with('OK', 'Contract Berhasil Diupdate');

    } catch (\Exception $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'ERR',
                'Gagal Mengupdate Contract: ' . $e->getMessage()
            );
    }
}
    public function destroy(Contract $contract)
    {
        $contract->delete(); // soft delete

        return redirect()
            ->route('contracts.index')
            ->with('OK', 'Contract berhasil dihapus.');
    }
    public function send(Contract $contract)
    {
        try {


            // Update status
            $contract->update([
                'status' => 'sent',
            ]);

            // Kirim WA ke employee
            // $this->sendWaContractSent($contract);

            return redirect()
                ->back()
                ->with('OK', 'Contract Berhasil Dikirim ke Employee');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('ERR', 'Gagal Mengirim Contract: ' . $e->getMessage());
        }
    }


    public function approveHRD(Contract $contract)
    {
        try {
            $qrPath = $this->generateQrForContract($contract, 'hrd');

            $contract->update([
                'status'        => 'signed-hrd',
                'hrd_signature' => auth()->id(),
                'hrd_signed_at' => now(),
                'hrd_qr_path'   => $qrPath,
                'verify_token'  => $contract->verify_token,
            ]);

            return back()->with('OK', 'Kontrak Berhasil Disetujui Head HRD');
        } catch (\Exception $e) {
            return back()->with('ERR', 'Gagal Menyetujui Kontrak: ' . $e->getMessage());
        }
    }
    public function approveHead(Contract $contract)
    {
        try {
            $qrPath = $this->generateQrForContract($contract, 'head');

            $contract->update([
                'status'         => 'signed-head',
                'head_signature' => auth()->id(),
                'head_signed_at' => now(),
                'head_qr_path'   => $qrPath,
                'verify_token'   => $contract->verify_token,
            ]);

            return back()->with('OK', 'Kontrak Berhasil Diselesaikan');
        } catch (\Exception $e) {
            return back()->with('ERR', 'Gagal Menyelesaikan Kontrak: ' . $e->getMessage());
        }
    }
    public function stop(Contract $contract)
{
    try {
        if ($contract->status !== 'signed') {
            return back()->with('ERR', 'Hanya kontrak yang sudah ditandatangani yang bisa di-stop.');
        }

        $contract->update([
            'status'     => 'stop',
            'stopped_at' => now(),
        ]);

        return back()->with('OK', 'Kontrak Berhasil Di-stop / Diselesaikan.');

    } catch (\Exception $e) {
        return back()->with('ERR', 'Gagal Menyelesaikan Kontrak: ' . $e->getMessage());
    }
}

    public function bulkSend(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('ERR', 'Tidak ada data yang dipilih.');
        }

        try {
            $contracts = Contract::whereIn('id', $ids)->get();

            // Validasi: semua harus draft
            $invalid = $contracts->where('status', '!=', 'draft');
            if ($invalid->isNotEmpty()) {
                return back()->with('ERR', 'Beberapa contract tidak berstatus Draft. Bulk send dibatalkan.');
            }

            Contract::whereIn('id', $ids)->update(['status' => 'sent']);

            return back()->with('OK', $contracts->count() . ' contract berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->with('ERR', 'Gagal mengirim contract: ' . $e->getMessage());
        }
    }

    public function bulkApproveHRD(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('ERR', 'Tidak ada data yang dipilih.');
        }

        try {
            $contracts = Contract::whereIn('id', $ids)->get();

            $invalid = $contracts->where('status', '!=', 'signed');
            if ($invalid->isNotEmpty()) {
                return back()->with('ERR', 'Beberapa contract tidak berstatus Signed. Bulk approve HRD dibatalkan.');
            }

            foreach ($contracts as $contract) {
                $qrPath = $this->generateQrForContract($contract, 'hrd');

                $contract->update([
                    'status'        => 'signed-hrd',
                    'hrd_signature' => auth()->id(),
                    'hrd_signed_at' => now(),
                    'hrd_qr_path'   => $qrPath,
                    'verify_token'  => $contract->verify_token,
                ]);
            }

            return back()->with('OK', $contracts->count() . ' contract berhasil disetujui Head HRD.');
        } catch (\Exception $e) {
            return back()->with('ERR', 'Gagal menyetujui contract: ' . $e->getMessage());
        }
    }

    public function bulkApproveHead(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('ERR', 'Tidak ada data yang dipilih.');
        }

        try {
            $contracts = Contract::whereIn('id', $ids)->get();

            $invalid = $contracts->where('status', '!=', 'signed-hrd');
            if ($invalid->isNotEmpty()) {
                return back()->with('ERR', 'Beberapa contract tidak berstatus Signed-HRD. Bulk approve Head dibatalkan.');
            }

            foreach ($contracts as $contract) {
                $qrPath = $this->generateQrForContract($contract, 'head');

                $contract->update([
                    'status'         => 'signed-head',
                    'head_signature' => auth()->id(),
                    'head_signed_at' => now(),
                    'head_qr_path'   => $qrPath,
                    'verify_token'   => $contract->verify_token,
                ]);
            }

            return back()->with('OK', $contracts->count() . ' contract berhasil diselesaikan.');
        } catch (\Exception $e) {
            return back()->with('ERR', 'Gagal menyelesaikan contract: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('ERR', 'Tidak ada data yang dipilih.');
        }

        try {
            $count = Contract::whereIn('id', $ids)->delete();

            return back()->with('OK', $count . ' contract berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('ERR', 'Gagal menghapus contract: ' . $e->getMessage());
        }
    }
   private function allowanceRulesByType(string $type): array
{
    return match ($type) {

        // =====================================================
        // MANAGERIAL
        // =====================================================

        'all-in' => [
            'project_allowance' => 'nullable|numeric|min:0',
        ],

        'gp-mahal-um-ut-fungsi' => [
            'cost_allowance'       => 'nullable|numeric|min:0',
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
            'functional_allowance' => 'nullable|numeric|min:0',
        ],

        'gp-um-ut-fungsi' => [
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
            'functional_allowance' => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // NON-MANAGERIAL
        // =====================================================

        'security' => [
            'cost_allowance'         => 'nullable|numeric|min:0',
            'meal_allowance'         => 'nullable|numeric|min:0',
            'transport_allowance'    => 'nullable|numeric|min:0',
            'security_incentive'     => 'nullable|numeric|min:0',
            'night_shift_allowance'  => 'nullable|numeric|min:0',
        ],

        'ob' => [
            'cost_allowance'      => 'nullable|numeric|min:0',
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
        ],

        'gp-um-ut-laut' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'sea_allowance'       => 'nullable|numeric|min:0',
        ],

        'gp-um-ut' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
        ],

        'gp-mahal-um-ut-fungsi-pls' => [
            'cost_allowance'       => 'nullable|numeric|min:0',
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
            'functional_allowance' => 'nullable|numeric|min:0',
            'pulse_allowance'      => 'nullable|numeric|min:0',
        ],

        'gp-mahal-um-ut' => [
            'cost_allowance'       => 'nullable|numeric|min:0',
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
            'functional_allowance' => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // PROJECT — EXISTING
        // =====================================================

        // PEP Lokal Bunyu — hanya Gaji Pokok
        'pep-lokal-buny' => [],

        // ELIS PHKT 5.2
        'elis-phkt-5-2' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'sea_allowance'       => 'nullable|numeric|min:0',
        ],

        // ELIS PHKT 6.1 — hanya Gaji Pokok
        'elis-phkt-6-1' => [],

        // ENI Muara Bakau (Lembur)
        'eni-muara-bakau-lembur' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],

        // ENI Muara Bakau (All-In)
        'eni-muara-bakau-all-in' => [
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
            'pulse_allowance'      => 'nullable|numeric|min:0',
            'functional_allowance' => 'nullable|numeric|min:0',
        ],

        // IPFMS-DOBU
        'ipfms-dobu' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'sea_allowance'       => 'nullable|numeric|min:0',
        ],
        'ipfms-dobu-2' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'sea_allowance'       => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // PROJECT — NEW: ENI
        // =====================================================

        // ENI Civil — All In (Gaji 25)
        // Gaji Pokok + Tunj. Fungsional
        'eni-civil-all-in' => [
            'functional_allowance' => 'nullable|numeric|min:0',
        ],

        // ENI Civil — Reguler (Gaji 09)
        // Gaji Pokok + Tunj. Kemahalan + UM + UT + Fungsi
     'eni-civil-reguler' => [
        'attendance_allowance' => 'nullable|numeric|min:0',
    ],

        // ENI Small Capital — All In
        // Gaji Pokok + Tunj. Jabatan (keduanya All-In)
        'eni-smallcapital-all-in' => [
            'position_allowance' => 'nullable|numeric|min:0',
        ],

        // ENI Small Capital — Reguler
        // Gaji Pokok + Uang Kehadiran (Makan & Transport)
        'eni-smallcapital-reguler' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // PROJECT — NEW: WARLOK MEDCO
        // =====================================================

        // Warlok Medco — All In
        // Gaji Pokok + Tunj. Jabatan
        'warlok-all-in' => [
            'position_allowance' => 'nullable|numeric|min:0',
        ],

        // Warlok Medco — Lembur (Reguler)
        // Gaji Pokok + Uang Kehadiran
        'warlok-lembur' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],

        // Warlok Medco — Security
        // Gaji Pokok + Tunj. Kehadiran + Insentif Khusus
        'warlok-security' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
            'security_incentive'   => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // PROJECT — NEW: PHSS MAJOR
        // =====================================================

        // PHSS Major — All In Type 1
        // Gaji Pokok + Tunj. Fungsional
        'phss-major-ai-1' => [
            'functional_allowance' => 'nullable|numeric|min:0',
        ],

        // PHSS Major — All In Type 2
        // Gaji Pokok + Tunj. Fungsional + Tunj. Makan & Transport
        'phss-major-ai-2' => [
            'functional_allowance' => 'nullable|numeric|min:0',
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
        ],

        // PHSS Major — All In Type 3 (On/Off Duty)
        // Hanya Gaji Pokok
        'phss-major-ai-3' => [],

        // PHSS Major — Driver BPN
        // Gaji Pokok + Uang Kehadiran
        'phss-driver' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],

        // PHSS Major — Humas
        // Gaji Pokok + Tunj. Fungsional
        'phss-humas' => [
            'functional_allowance' => 'nullable|numeric|min:0',
        ],

        // PHSS Major — Reguler
        // Gaji Pokok + Uang Kehadiran
        'phss-reguler' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],

        // PHSS Major — Security WS
        // Gaji Pokok + Tunj. Kehadiran + Insentif Khusus
        'phss-security' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
            'security_incentive'   => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // PROJECT — NEW: SAND MONITORING
        // =====================================================

        // Sand Monitoring — Teknisi 1
        // Skema kompleks: Basic + Housing + Transport + EWHC
        // + Daily + Annual Leave + Severance
        'sandmon-teknisi-1' => [
            'housing_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance'    => 'nullable|numeric|min:0',
            'ewhc_allowance'         => 'nullable|numeric|min:0',
            'daily_allowance'        => 'nullable|numeric|min:0',
            'annual_leave_allowance' => 'nullable|numeric|min:0',
            'severance_allowance'    => 'nullable|numeric|min:0',
        ],

        // Sand Monitoring — Teknisi 2
        // Sama dengan Teknisi 1, hanya beda nominal
        'sandmon-teknisi-2' => [
            'housing_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance'    => 'nullable|numeric|min:0',
            'ewhc_allowance'         => 'nullable|numeric|min:0',
            'daily_allowance'        => 'nullable|numeric|min:0',
            'annual_leave_allowance' => 'nullable|numeric|min:0',
            'severance_allowance'    => 'nullable|numeric|min:0',
        ],


        // =====================================================
        // PROJECT — NEW: LAIN-LAIN
        // =====================================================

        // Schedule 5-2 Rev. 2026 (Gaji 09)
        // Hanya Gaji Pokok
        'sched-5-2' => [],

        // LAWE LAWE — Reguler
        // Gaji Pokok + Uang Kehadiran
        'lawe-lawe-reguler' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],

        // LAWE LAWE — All In
        // Gaji Pokok + Tunj. Jabatan
        'lawe-lawe-all-in' => [
            'position_allowance' => 'nullable|numeric|min:0',
        ],

         'harian-biasa' => [], // Kosongkan karena tidak ada tunjangan


        // =====================================================
        // DEFAULT
        // =====================================================

        default => [],
    };
}
    public function export(Request $request)
    {
        Carbon::setLocale('id');
        $filters = [
        'category'        => $request->query('category'),
        'type'            => $request->query('type'),
        'project'         => $request->query('project'),
        'status'          => $request->query('status'),
        'start_date_from' => $request->query('start_date_from'),
        'start_date_to'   => $request->query('start_date_to'),
        'end_date_only'   => $request->query('end_date_only'),
    ];

        $tanggal  = now()->translatedFormat('d-M-Y'); // 19-Sep-2026
        $filename = "Laporan-Contract_{$tanggal}.xlsx";

        return Excel::download(new ContractsExport($filters), $filename);
    }

   public function createNewFromExisting($id)
{
    $source = Contract::with(['user', 'project', 'headUser'])
        ->findOrFail($id);

    // Employee candidates — SAMAKAN dengan create()
    $employees = User::whereNotNull('employee_number')
        ->orderBy('name')
        ->get();

    // Head candidates — SAMAKAN dengan create()
    $heads = User::whereNotNull('employee_number')
        ->orderBy('name')
        ->get();

    // Projects — hanya active
    $projects = Project::where('is_active', 1)
        ->orderBy('name')
        ->get();

    return view('admin.hrd.contracts.create-new-from-existing', [
        'source'    => $source,
        'type'      => $source->type,
        'category'  => $source->category,
        'employees' => $employees,
        'heads'     => $heads,
        'projects'  => $projects,
    ]);
}
   public function allowanceFields(Request $request)
{
    $type = $request->query('type');

    $allowanceTypes = [
        'all-in', 'gp-mahal-um-ut-fungsi', 'gp-um-ut-fungsi',
        'security', 'ob', 'gp-um-ut-laut', 'gp-um-ut',
        'gp-mahal-um-ut-fungsi-pls', 'gp-mahal-um-ut',

        // Project lama
        'pep-lokal-buny', 'elis-phkt-5-2', 'elis-phkt-6-1',
        'eni-muara-bakau-lembur', 'eni-muara-bakau-all-in',
        'ipfms-dobu',
        'ipfms-dobu-2',

        // Project baru
        'eni-civil-all-in', 'eni-civil-reguler',
        'eni-smallcapital-all-in', 'eni-smallcapital-reguler',
        'warlok-all-in', 'warlok-lembur', 'warlok-security',
        'phss-major-ai-1', 'phss-major-ai-2', 'phss-major-ai-3',
        'phss-driver', 'phss-humas', 'phss-reguler', 'phss-security',
        'sandmon-teknisi-1', 'sandmon-teknisi-2',
        'sched-5-2', 'lawe-lawe-reguler', 'lawe-lawe-all-in',
    ];

    if (!in_array($type, $allowanceTypes)) {
        return response()->json(['html' => '']);
    }

    $html = view('admin.hrd.contracts.partials.create-pasal5', [
        'contract' => null,
        'type'     => $type,
    ])->render();

    return response()->json(['html' => $html]);
}

    public function verify($token)
    {
        $contract = Contract::with(['user', 'project', 'headUser'])
            ->where('verify_token', $token)
            ->first();

        if (!$contract) {
            return response()
                ->view('admin.hrd.contracts.verify-invalid')
                ->setStatusCode(404);
        }

        return view('admin.hrd.contracts.verify', compact('contract'));
    }


    private function generateQrForContract(Contract $contract, string $role): string
    {
        if (empty($contract->verify_token)) {
            $contract->verify_token = (string) \Illuminate\Support\Str::uuid();
        }

        $verifyUrl = route('contracts.verify', $contract->verify_token);

        $qrCode = new QrCode(
            data: $verifyUrl,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
        );

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // safe file name so the path won't break
        $safeNumber = str_replace(['/', '\\', ' ', ':', '*', '?', '"', '<', '>', '|'], '-', $contract->contract_number);

        $qrPath = 'contracts/qr/' . $role . '/' . $safeNumber . '.png';

        Storage::disk('public')->put($qrPath, $result->getString());

        return $qrPath;
    }
    /**
     * Kirim notifikasi WA ke employee setelah contract dikirim.
     */
    private function sendWaContractSent(Contract $contract)
    {
        $employee = $contract->user;

        // Skip kalau tidak ada nomor telepon
        if (!$employee || empty($employee->phone)) {
            Log::warning('WA tidak dikirim: employee tidak punya nomor telepon', [
                'contract_id' => $contract->id,
            ]);
            return;
        }

        // Susun pesan
        $message = "*Contract Management*\n\n"
            . "Halo {$employee->name},\n\n"
            . "Anda menerima contract baru:\n\n"
            . "No: *{$contract->contract_number}*\n"
            . "Judul: {$contract->title}\n"
            . "Periode: "
            . optional($contract->start_date)->format('d M Y')
            . " s/d "
            . optional($contract->end_date)->format('d M Y')
            . "\n\n"
            . "Silakan cek dan tanda tangani melalui link berikut:\n"
            . route('contracts.show', $contract->id);

        // Kirim
        $this->sendFonnte($employee->phone, $message);
    }

    /**
     * Helper generic untuk kirim WA via Fonnte.
     */
    private function sendFonnte(string $target, string $message): bool
    {
        try {

            $token = config('services.fonnte.token');

            if (empty($token)) {
                Log::warning('Fonnte token belum diset di .env');
                return false;
            }

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => $token,
                ])
                ->timeout(10)
                ->post('https://api.fonnte.com/send', [
                    'target'  => $target,
                    'message' => $message,
                ]);

            if ($response->successful()) {
                Log::info('WA terkirim', [
                    'target'   => $target,
                    'response' => $response->json(),
                ]);
                return true;
            }

            Log::warning('Gagal kirim WA', [
                'target'   => $target,
                'response' => $response->json(),
            ]);
            return false;
        } catch (\Exception $e) {

            Log::error('Error kirim WA: ' . $e->getMessage(), [
                'target' => $target,
            ]);
            return false;
        }
    }
}
