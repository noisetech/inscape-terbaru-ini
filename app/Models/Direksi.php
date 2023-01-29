<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direksi extends Model
{
    use HasFactory;

    protected $table = 'direksi_pengadaan';

    protected $fillable = [
        'pengadaan_id', 'nama', 'dokumen', 'status'
    ];
}
