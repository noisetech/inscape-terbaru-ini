<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasiSubBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesifikasi_sub_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_barang_id');
            $table->foreignId('spesifikasi_parameter_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sub_barang_id')->references('id')
                ->on('sub_barang')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('spesifikasi_parameter_id')->references('id')
                ->on('spesifikasi_parameter')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spesifikasi_sub_barang');
    }
}
