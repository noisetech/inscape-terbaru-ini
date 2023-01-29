<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StepPengadaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'step_pengadaan';

    protected $fillable = [
        'pengadaan_id', 'step', 'deskripsi', 'status'
    ];

    public function pengadaaan(){
        return $this->belongsTo(Pengadaan::class, 'pengadaan_id', 'id');
    }
}
