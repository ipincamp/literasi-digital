<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teslet extends Model
{
    use HasFactory;

    protected $table = 'teslet';

    protected $fillable = ['judul', 'gambar', 'keterangan'];
}
