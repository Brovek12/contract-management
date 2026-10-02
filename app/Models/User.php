<?php

namespace App\Models;

use App\Models\HRD\Contract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'warehouse_id',
        'foto',
        'name',
        'username',
        'email',
        'password',
        'employee_number',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }


    // =========================================================
    // RELATIONS TO CONTRACT
    // =========================================================

    /**
     * Contract yang diterima user sebagai employee.
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'user_id');
    }

    /**
     * Contract yang ditangani user sebagai HRD.
     */
    public function hrdContracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'hrd_user_id');
    }

    /**
     * Contract yang di-approve user sebagai Head of Branch.
     */
    public function headContracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'head_user_id');
    }

    /**
     * Contract yang dibuat user.
     */
    public function createdContracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'created_by');
    }
}