<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    // Pastikan nama kolom ini SAMA PERSIS dengan di Migration
    protected $fillable = [
        'no_kunjungan',
        'nama',
        'nomor_induk',
        'instansi',
        'prodi',
        'keperluan',
        'status' // Status optional jika ingin diisi default dari database
    ];
}