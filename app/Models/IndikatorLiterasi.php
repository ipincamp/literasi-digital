<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorLiterasi extends Model
{
    use HasFactory;

    protected $table = 'indikator_literasi';

    protected $fillable = ['keterangan'];
}
