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
        Schema::create('tb_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->dateTime('tanggallahir');
            $table->string('jeniskelamin');
            $table->string('alamat');
            $table->unsignedBigInteger('id_provinsi');
            $table->unsignedBigInteger('id_kabupaten');
            $table->timestamps();

            $table->foreign('id_provinsi')->references('id')->on('tb_provinsi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_kabupaten')->references('id')->on('tb_kabupaten')->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('tb_penduduk');
    }
};
