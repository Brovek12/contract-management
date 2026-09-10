<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\HRD\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    return view('admin.hrd.contracts.index', compact(
        'data',
        'employees',
        'projects'
    ));
}

public function create()
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

    return view('admin.hrd.contracts.create', compact(
        'employees',
        'projects',
        'heads'
    ));
}

public function store(Request $request)
{
    // dd($request->all());
    try {

        $request->validate([
            // Contract
            'contract_number' => 'required|string|max:255|unique:contracts,contract_number',
            'contract_date'   => 'required|date',
            'title'           => 'required|string|max:255',

            // Employee
            'user_id'         => 'required|exists:users,id',
            'employee_name'   => 'required|string|max:255',
            'department'     => 'nullable|string|max:255',
            'nik'             => 'nullable|string|max:50',
            'ktp_number'     => 'nullable|string|max:50',
            'birth_place'    => 'nullable|string|max:255',
            'birth_date'     => 'nullable|date',
            'age_at_contract'=> 'nullable|integer|min:0|max:100',
            'gender'         => 'nullable|string|max:50',
            'address'        => 'nullable|string',

            // Period
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',

            // Placement
            'project_id'     => 'nullable|exists:projects,id',
            'head_user_id'   => 'nullable|exists:users,id',
            'position'       => 'required|string|max:255',
            'work_location'  => 'required|string|max:255',
            'domicile'       => 'required|string|max:255',

            // Salary
            'basic_salary'   => 'required|numeric|min:0',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Simpan Contract
        |--------------------------------------------------------------------------
        */

        Contract::create([

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
    $contract->load([
        'user',
        'project',
        'creator',
        'headUser',
    ]);

    return view(
        'admin.hrd.contracts.show',
        compact('contract')
    );
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

        $request->validate([
            'contract_number' => 'required|string|max:255|unique:contracts,contract_number,' . $contract->id,
            'contract_date'   => 'required|date',
            'title'           => 'required|string|max:255',

            'user_id'         => 'required|exists:users,id',
            'employee_name'   => 'required|string|max:255',

            'department'      => 'nullable|string|max:255',
            'nik'             => 'nullable|string|max:50',
            'ktp_number'     => 'nullable|string|max:50',
            'birth_place'    => 'nullable|string|max:255',
            'birth_date'     => 'nullable|date',
            'age_at_contract'=> 'nullable|integer|min:0|max:100',
            'gender'         => 'nullable|string|max:50',
            'address'        => 'nullable|string',

            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',

            'project_id'     => 'nullable|exists:projects,id',
            'head_user_id'   => 'nullable|exists:users,id',

            'position'       => 'required|string|max:255',
            'work_location'  => 'required|string|max:255',
            'domicile'       => 'required|string|max:255',

            'basic_salary'   => 'required|numeric|min:0',
        ]);


        $contract->update([

            'contract_number' => $request->contract_number,
            'contract_date'   => $request->contract_date,
            'title'           => $request->title,

            'user_id'         => $request->user_id,
            'project_id'      => $request->project_id,
            'head_user_id'    => $request->head_user_id,

            'employee_name'   => $request->employee_name,
            'department'      => $request->department,
            'nik'             => $request->nik,
            'ktp_number'      => $request->ktp_number,
            'birth_place'     => $request->birth_place,
            'birth_date'      => $request->birth_date,
            'age_at_contract' => $request->age_at_contract,
            'gender'          => $request->gender,
            'address'         => $request->address,

            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,

            'position'        => $request->position,
            'work_location'   => $request->work_location,
            'domicile'        => $request->domicile,

            'basic_salary'    => $request->basic_salary,
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


}