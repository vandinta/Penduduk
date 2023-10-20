<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'tb_penduduk';

    protected $fillable = [
        'nama',
        'nik',
        'tanggallahir',
        'jeniskelamin',
        'alamat',
        'id_provinsi',
        'id_kabupaten',
    ];
}
