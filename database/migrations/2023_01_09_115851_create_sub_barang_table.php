<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->string('sub_barang');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')
                ->on('barang')
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
        Schema::dropIfExists('sub_barang');
    }
}
