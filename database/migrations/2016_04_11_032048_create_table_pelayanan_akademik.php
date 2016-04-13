<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePelayananAkademik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelayanan_akademiks', function (Blueprint $table) {
            $table->increments('id_pelayan_akademik');
            $table->string('username')->references('username')->on('users');
            $table->string('tipe_surat');
            $table->timestamps('waktu_pengajuan');
            $table->string('email');
            $table->string('no_hp');
            $table->text('keperluan');
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
        Schema::drop('pelayanan_akademiks');
    }
}
