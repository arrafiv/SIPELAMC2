<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->increments('id_pengajuan_surat');
            $table->string('username')->references('username')->on('users');
            $table->timestamps('waktu_pengajuan');
            $table->string('email');
            $table->string('no_hp');
            $table->string('nama_kegiatan');
            $table->date('tanggal_mulai_kegiatan');
            $table->date('tanggal_selesai_kegiatan');
            $table->string('penyelenggara');
            $table->string('deskripsi');
            $table->string('status', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kegiatans');
    }
}
