<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_surat');
            $table->string('status_surat');
            $table->string('no_urut_sementara');
            $table->string('no_awal');
            $table->string('lampiran');
            $table->string('sifat');
            $table->string('jenis');
            $table->string('no_surat');
            $table->string('judul');
            $table->text('kepada');
            $table->text('tembusan');
            $table->text('isi_surat');
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
        Schema::dropIfExists('surat_keluars');
    }
}
