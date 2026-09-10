<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'tanggal_kadaluarsa',
        'vendor',
        'file_pdf',
        'rev',
    ];
}
