<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kabupaten');
            $table->unsignedBigInteger('id_provinsi');
            $table->timestamps();

            $table->foreign('id_provinsi')->references('id')->on('tb_provinsi')->cascadeOnUpdate()->cascadeOnDelete();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kabupaten');
    }
};
