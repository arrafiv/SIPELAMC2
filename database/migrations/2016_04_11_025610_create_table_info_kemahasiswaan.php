<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInfoKemahasiswaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_kemahasiswaans', function (Blueprint $table) {
            $table->increments('id_info');
            $table->string('username')->references('username')->on('users');
            $table->timestamps('waktu_publish');
            $table->string('judul');
            $table->text('isi_info');
            $table->string('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('info_kemahasiswaans');
    }
}
