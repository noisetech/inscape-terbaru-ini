<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadaan_id');
            $table->enum('step', ['B.1', 'B.2', 'B.3', 'B.4', 'B.5.1', 'B.5.2', 'B.6', 'B.7', 'K.1', 'K.2', 'K.3', 'K.4', 'K.5.1', 'K.5.2', 'K.6', 'K.7']);
            $table->longText('deskripsi');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pengadaan_id')->references('id')
            ->on('pengadaan')
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
        Schema::dropIfExists('step_pengadaan');
    }
}
