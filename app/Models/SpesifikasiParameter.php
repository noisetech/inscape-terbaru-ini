<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiParameter extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_parameter';

    protected $fillable = [
        'parameter_id', 'spesifikasi', 'level'
    ];

    public function parameter(){
        return $this->belongsTo(ParameterBarang::class);
    }
}
