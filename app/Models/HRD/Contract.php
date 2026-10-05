<?php

namespace App\Models\HRD;

use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Contract extends Model
{
    protected $fillable = [

        // =====================================================
        // INFORMASI CONTRACT
        // =====================================================

        'contract_number',
        'verify_token',     // ← TAMBAH INI
        'contract_date',
        'title',
        'category',
        'type',

        // =====================================================
        // RELATION
        // =====================================================

        'user_id',
        'project_id',
        'hrd_user_id',
        'head_user_id',

        // =====================================================
        // DATA EMPLOYEE
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
        'grade',
        'work_location',
        'domicile',

        // =====================================================
        // SALARY
        // =====================================================

        'basic_salary',

        // =====================================================
        // ALLOWANCES
        // =====================================================

        'project_allowance',
        'cost_allowance',
        'meal_allowance',
        'transport_allowance',
        'functional_allowance',
        'security_incentive',
        'night_shift_allowance',
        'sea_allowance',
        'pulse_allowance',
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
        // HRD SIGNATURE + QR
        // =====================================================

        'hrd_signature',
        'hrd_signed_at',
        'hrd_qr_path',

        // =====================================================
        // HEAD OF BRANCH SIGNATURE + QR
        // =====================================================

        'head_signature',
        'head_signed_at',
        'head_qr_path',

        // =====================================================
        // CREATOR
        // =====================================================

        'created_by',
    ];


    protected $casts = [

        'contract_date' => 'date',
        'birth_date'    => 'date',
        'start_date'    => 'date',
        'end_date'      => 'date',

        'employee_signed_at' => 'datetime',
        'hrd_signed_at'      => 'datetime',
        'head_signed_at'     => 'datetime',

        'basic_salary' => 'decimal:2',

        // Allowances
        'project_allowance'     => 'decimal:2',
        'cost_allowance'        => 'decimal:2',
        'meal_allowance'        => 'decimal:2',
        'transport_allowance'   => 'decimal:2',
        'functional_allowance'  => 'decimal:2',
        'security_incentive'    => 'decimal:2',
        'night_shift_allowance' => 'decimal:2',
        'sea_allowance'         => 'decimal:2',
        'pulse_allowance'       => 'decimal:2',
        'attendance_allowance'  => 'decimal:2',
    ];


    // =========================================================
    // BOOTED — auto-generate verify_token
    // =========================================================

    protected static function booted(): void
    {
        static::creating(function ($contract) {
            if (empty($contract->verify_token)) {
                $contract->verify_token = (string) Str::uuid();
            }
        });
    }


    // =========================================================
    // RELATIONS
    // =========================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function hrdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'hrd_user_id');
    }

    public function headUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_user_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}