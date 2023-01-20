<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterBarang extends Model
{
    use HasFactory;

    protected $table = 'parameter';

    protected $fillable = [
        'barang_id', 'parameter', 'bobot'
    ];
}
