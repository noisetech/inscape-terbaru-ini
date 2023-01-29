<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_barang_id');
            $table->integer('skor_likelihood_level');
            $table->integer('likelihood_level');
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sub_barang_id')->references('id')
                ->on('sub_barang')
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
        Schema::dropIfExists('pengadaan_detail');
    }
}
