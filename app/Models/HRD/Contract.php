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
        'type',

        // =====================================================
        // RELATION
        // =====================================================

        'user_id',
        'project_id',
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

        'signature',
        'signed_at',

        // =====================================================
        // HEAD SIGNATURE
        // =====================================================

        'head_signature',
        'head_signed_at',

        // =====================================================
        // CREATOR
        // =====================================================

        'created_by',
    ];


    protected $casts = [

        'contract_date'   => 'date',

        'birth_date'      => 'date',

        'start_date'      => 'date',

        'end_date'        => 'date',

        'signed_at'       => 'datetime',

        'head_signed_at'  => 'datetime',

        'basic_salary'    => 'decimal:2',
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