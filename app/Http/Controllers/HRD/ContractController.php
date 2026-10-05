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
            'pep-lokal-buny',
            'elis-phkt-5-2',
            'elis-phkt-6-1',
            'eni-muara-bakau-lembur',
            'eni-muara-bakau-all-in',
            'ipfms-dobu',
        ],
    ];


    if (!array_key_exists($category, $typesByCategory)) {
        abort(403);
    }

    if (!in_array($type, $typesByCategory[$category])) {
        abort(403);
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
        | 1. VALIDASI CATEGORY & TYPE
        |--------------------------------------------------------------------------
        */

        $typesByCategory = [
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
            'pep-lokal-buny',
            'elis-phkt-5-2',
            'elis-phkt-6-1',
            'eni-muara-bakau-lembur',
            'eni-muara-bakau-all-in',
            'ipfms-dobu',
        ],
    ];

        $category = $request->input('category');
        $type     = $request->input('type');

        if (!array_key_exists($category, $typesByCategory) ||
            !in_array($type, $typesByCategory[$category])) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | 2. VALIDASI UMUM
        |--------------------------------------------------------------------------
        */

        $request->validate([
            // Contract
            'contract_number' => 'required|string|max:255|unique:contracts,contract_number',
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
    'project_allowance'      => null,
    'cost_allowance'         => null,
    'meal_allowance'         => null,
    'transport_allowance'    => null,
    'functional_allowance'   => null,
    'security_incentive'     => null,
    'night_shift_allowance'  => null,
    'sea_allowance'          => null,
    'pulse_allowance'        => null,
    'attendance_allowance'   => null,   // ← baru
];

        foreach (array_keys($allowanceRules) as $field) {
            $allowances[$field] = $request->input($field, 0);
        }


        /*
        |--------------------------------------------------------------------------
        | 5. SIMPAN CONTRACT
        |--------------------------------------------------------------------------
        */

        Contract::create([

            // Contract information
            'contract_number' => $request->contract_number,
            'contract_date'   => $request->contract_date,
            'category'        => $category,
            'type'            => $type,
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

            // Allowances (sesuai type)
            'project_allowance'      => $allowances['project_allowance'],
            'cost_allowance'         => $allowances['cost_allowance'],
            'meal_allowance'         => $allowances['meal_allowance'],
            'transport_allowance'    => $allowances['transport_allowance'],
            'functional_allowance'   => $allowances['functional_allowance'],
            'security_incentive'     => $allowances['security_incentive'],
            'night_shift_allowance'  => $allowances['night_shift_allowance'],
            'sea_allowance'          => $allowances['sea_allowance'],
            'pulse_allowance'        => $allowances['pulse_allowance'],
            'attendance_allowance'   => $allowances['attendance_allowance'],   // ← baru

            // Initial status
            'status'          => 'draft',

            // Created by
            'created_by'      => auth()->id(),
        ]);


        return redirect()
            ->route('contracts.index')
            ->with('OK', 'Contract Berhasil Dibuat');


    } catch (\Exception $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'ERR',
                'Gagal Membuat Contract: ' . $e->getMessage()
            );
    }
}

public function show(Contract $contract)
{
     $user = Auth::user();
    // ✅ Pengamanan: employee hanya boleh lihat kontrak miliknya
    if (auth()->user()->hasRole('Employee') && $contract->user_id !== auth()->id()) {
        abort(403, 'Kontrak ini bukan milik Anda.');
    }

    $contract->load([
        'user',
        'project',
        'creator',
        'headUser',
    ]);

    if ($contract->type === 'ipfms-dobu') {
        return view('admin.hrd.contracts.show-dobu', [
            'contract' => $contract,
            'type'     => $contract->type,
            'category' => $contract->category,
        ]);
    }

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
        ];

        foreach (array_keys($allowanceRules) as $field) {
            $allowances[$field] = $request->input($field, 0);
        }


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

            // Contract period
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,

            // Placement
            'position'        => $request->position,
            'work_location'   => $request->work_location,
            'domicile'        => $request->domicile,

            // Salary
            'basic_salary'    => $request->basic_salary,

            // Allowances (sesuai type)
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
    // Delete Contract
}
public function send(Contract $contract)
{
    try {

        if ($contract->status !== 'draft') {
            return redirect()
                ->back()
                ->with('ERR', 'Contract tidak dapat dikirim karena status bukan Draft.');
        }

        $contract->update([
            'status' => 'sent',
        ]);

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
        // PROJECT
        // =====================================================

        // D1: PEP Lokal Bunyu
        'pep-lokal-buny' => [
            // hanya Gaji Pokok, tidak ada tunjangan
        ],

        // D2: ELIS PHKT 5.2
        'elis-phkt-5-2' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'sea_allowance'       => 'nullable|numeric|min:0',
        ],

        // D3: ELIS PHKT 6.1
        'elis-phkt-6-1' => [
            // hanya Gaji Pokok, tidak ada tunjangan
        ],

        // D4: ENI Muara Bakau (LEMBUR)
        'eni-muara-bakau-lembur' => [
            'attendance_allowance' => 'nullable|numeric|min:0',
        ],

        // D5: ENI Muara Bakau (All-in)
        'eni-muara-bakau-all-in' => [
            'meal_allowance'       => 'nullable|numeric|min:0',
            'transport_allowance'  => 'nullable|numeric|min:0',
            'pulse_allowance'      => 'nullable|numeric|min:0',
            'functional_allowance' => 'nullable|numeric|min:0',
        ],

        // D6: IPFMS-DOBU
        'ipfms-dobu' => [
            'meal_allowance'      => 'nullable|numeric|min:0',
            'transport_allowance' => 'nullable|numeric|min:0',
            'sea_allowance'       => 'nullable|numeric|min:0',
        ],


        default => [],
    };
}
public function export(Request $request)
{
    Carbon::setLocale('id');
    $filters = [
        'category'   => $request->input('category'),
        'type'       => $request->input('type'),
        'project'    => $request->input('project'),
        'status'     => $request->input('status'),
        'start_date' => $request->input('start_date'),
        'end_date'   => $request->input('end_date'),
    ];

    $tanggal  = now()->translatedFormat('d-M-Y'); // 19-Sep-2026
$filename = "Laporan-Contract_{$tanggal}.xlsx";

    return Excel::download(new ContractsExport($filters), $filename);
}

public function createNewFromExisting($id)
{
    $source = Contract::with(['user', 'project', 'headUser'])
        ->findOrFail($id);

    // Employee candidates
    $employees = User::role('Employee')->orderBy('name')->get();

    // Head candidates (HRD Head + GM)
    $heads = User::role(['HRD_Head', 'General_Manager'])->orderBy('name')->get();

    // Projects
    $projects = Project::orderBy('name')->get();

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
        'pep-lokal-buny', 'elis-phkt-5-2', 'elis-phkt-6-1',
        'eni-muara-bakau-lembur', 'eni-muara-bakau-all-in', 'ipfms-dobu',
    ];

    if (!in_array($type, $allowanceTypes)) {
        return response()->json(['html' => '']);
    }

    $html = view('admin.hrd.contracts.partials.create-pasal5', [
        'contract' => null, // mode create → field kosong
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

}