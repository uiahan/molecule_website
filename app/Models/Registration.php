<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'domisili_perusahaan',
        'peserta',
        'jabatan',
        'akan_hadir',
        'telah_scan',
        'kode',
        'qr',
        'unique_fields',
    ];

    protected $casts = [
        'unique_fields' => 'array', // Casting unique_fields menjadi array JSON jika ada
    ];
}
