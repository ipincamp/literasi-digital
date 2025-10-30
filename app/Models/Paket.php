<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';

    protected $fillable = [
        'nama_paket',
        'status',
    ];

    protected $attributes = [
        'status' => 'aktif',
    ];
}
