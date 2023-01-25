<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiSubBarang extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_sub_barang';

    protected $fillable = [
        'sub_barang_id', 'spesifikasi_paramaeter_id'
    ];

    public function sub_barang()
    {
        return $this->belongsTo(SubBarang::class, 'sub_barang_id', 'id');
    }

    public function spesifikasi_parameter()
    {
        return $this->belongsTo(SpesifikasiParameter::class, 'spesifikasi_parameter_id', 'id');
    }
}
