<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'indikator_soal',
        'soal',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'kunci_jawaban',
        'pembahasan',
        'domain_kognitif',
        'indikator_literasi',
        'teslet',
        'paket',
    ];

    public function domain()
    {
        return $this->belongsTo(DomainKognitif::class, 'domain_kognitif');
    }

    public function indikator()
    {
        return $this->belongsTo(IndikatorLiterasi::class, 'indikator_literasi');
    }

    public function teslet()
    {
        return $this->belongsTo(Teslet::class, 'teslet');
    }
}
