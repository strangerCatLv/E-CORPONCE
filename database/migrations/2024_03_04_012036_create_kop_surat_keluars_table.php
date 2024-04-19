<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKopSuratKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kop_surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('nama_sekolah');
            $table->string('alamat');   
            $table->string('website');
            $table->string('email');
            $table->string('telp');
            $table->string('kepala_sekolah');
            $table->string('nip_kepala_sekolah');
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
        Schema::dropIfExists('kop_surat_keluars');
    }
}
