<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->integer('status_surat');
            $table->integer('id_user');
            $table->string('no_surat');
            $table->string('tgl_surat');
            $table->date('diterima_tgl');
            $table->string('instansi_pengirim');
            $table->string('no_agenda');
            $table->string('klasifikasi');
            $table->text('perihal');
            $table->string('lampiran');
            $table->string('status');
            $table->string('sifat');
            $table->text('file');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuks');
    }
}
