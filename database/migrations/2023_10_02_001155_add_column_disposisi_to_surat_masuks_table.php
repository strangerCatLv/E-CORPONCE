<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDisposisiToSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->date('tgl_disposisi')->nullable();
            $table->integer('id_pegawai_disposisi')->nullable();
            $table->string('catatan_disposisi')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->date('tgl_disposisi')->nullable();
            $table->integer('id_pegawai_disposisi')->nullable();
            $table->string('catatan_disposisi')->nullable();
            
        });
    }
}
