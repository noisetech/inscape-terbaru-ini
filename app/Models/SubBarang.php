<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBarang extends Model
{
    use HasFactory;

    protected $table = 'sub_barang';

    protected $fillable = [
        'barang_id', 'sub_barang'
    ];
}
