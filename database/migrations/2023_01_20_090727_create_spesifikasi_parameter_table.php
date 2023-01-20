<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasiParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesifikasi_parameter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parameter_id');
            $table->text('spesifikasi')->nullable();
            $table->integer('level')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parameter_id')->references('id')
            ->on('parameter')
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
        Schema::dropIfExists('spesifikasi_parameter');
    }
}
