<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengadaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengadaan';

    protected $fillable = [
        'unit_id', 'tahun_id', 'no_nota_dinas', 'jenis', 'file', 'anggaran', 'disposisi'
    ];

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function tahun(){
        return $this->belongsTo(Tahun::class, 'tahun_id', 'id');
    }

    public function step(){
        return $this->hasMany(StepPengadaan::class);
    }


}
