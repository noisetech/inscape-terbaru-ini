<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id');
            $table->foreignId('tahun_id');
            $table->string('no_nota_dinas');
            $table->string('jenis')->nullable();
            $table->string('file')->nullable();
            $table->integer('anggaran');
            $table->string('disposisi')->nullable();


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('unit_id')->references('id')
                ->on('unit')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tahun_id')->references('id')
                ->on('tahun')
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
        Schema::dropIfExists('pengadaan');
    }
}
