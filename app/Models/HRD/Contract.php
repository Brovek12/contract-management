<?php

namespace App\Models\HRD;

use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    protected $fillable = [

        // =====================================================
        // INFORMASI CONTRACT
        // =====================================================

        'contract_number',
        'contract_date',
        'title',
        'category',        // ← baru
        'type',

        // =====================================================
        // RELATION
        // =====================================================

        // Employee
        'user_id',

        // Project
        'project_id',

        // HRD
        'hrd_user_id',

        // Head of Branch
        'head_user_id',

        // =====================================================
        // DATA EMPLOYEE
        // Snapshot data employee saat contract dibuat
        // =====================================================

        'employee_name',
        'department',
        'nik',
        'ktp_number',
        'birth_place',
        'birth_date',
        'age_at_contract',
        'gender',
        'address',

        // =====================================================
        // CONTRACT PERIOD
        // =====================================================

        'start_date',
        'end_date',

        // =====================================================
        // PENEMPATAN
        // =====================================================

        'position',
        'work_location',
        'domicile',

        // =====================================================
        // SALARY
        // =====================================================

        'basic_salary',

        // =====================================================
        // ALLOWANCES
        // Diisi sesuai type contract
        // =====================================================

        'project_allowance',      // ← baru (all-in)
        'cost_allowance',         // ← baru (gp-mahal-um-ut-fungsi)
        'meal_allowance',         // ← baru (per hari)
        'transport_allowance',    // ← baru (per hari)
        'functional_allowance',   // ← baru (per hari)
        'security_incentive',     // ← baru (security)
        'night_shift_allowance',  // ← baru (security)
        'sea_allowance',          // ← baru (gp-um-ut-laut)
        'pulse_allowance',        // ← baru (gp-mahal-um-ut-fungsi-pls)
        
'attendance_allowance',

        // =====================================================
        // FILE
        // =====================================================

        'file_path',

        // =====================================================
        // STATUS
        // =====================================================

        'status',

        // =====================================================
        // EMPLOYEE SIGNATURE
        // =====================================================

        'employee_signature',
        'employee_signed_at',

        // =====================================================
        // HRD SIGNATURE
        // =====================================================

        'hrd_signature',
        'hrd_signed_at',

        // =====================================================
        // HEAD OF BRANCH SIGNATURE
        // =====================================================

        'head_signature',
        'head_signed_at',

        // =====================================================
        // CREATOR
        // =====================================================

        'created_by',
    ];


    protected $casts = [

        'contract_date' => 'date',

        'birth_date' => 'date',

        'start_date' => 'date',

        'end_date' => 'date',

        'employee_signed_at' => 'datetime',

        'hrd_signed_at' => 'datetime',

        'head_signed_at' => 'datetime',

        'basic_salary' => 'decimal:2',

        // Allowances
        'project_allowance'    => 'decimal:2',   // ← baru
        'cost_allowance'       => 'decimal:2',   // ← baru
        'meal_allowance'       => 'decimal:2',   // ← baru
        'transport_allowance'  => 'decimal:2',   // ← baru
        'functional_allowance' => 'decimal:2',   // ← baru

        
        'security_incentive'     => 'decimal:2',   // ← baru
        'night_shift_allowance'  => 'decimal:2',   // ← baru
        'sea_allowance'          => 'decimal:2',   // ← baru
        'pulse_allowance'        => 'decimal:2',   // ← baru
        'attendance_allowance'        => 'decimal:2',   // ← baru
    ];


    // =========================================================
    // EMPLOYEE
    // =========================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    // =========================================================
    // PROJECT
    // =========================================================

    public function project(): BelongsTo
    {
        return $this->belongsTo(
            Project::class,
            'project_id'
        );
    }


    // =========================================================
    // HRD
    // =========================================================

    public function hrdUser(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'hrd_user_id'
        );
    }


    // =========================================================
    // HEAD OF BRANCH
    // =========================================================

    public function headUser(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'head_user_id'
        );
    }


    // =========================================================
    // CREATED BY
    // =========================================================

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}