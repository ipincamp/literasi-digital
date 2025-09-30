<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainKognitif extends Model
{
    use HasFactory;

    protected $table = 'domain_kognitif';

    protected $fillable = ['keterangan'];
}
