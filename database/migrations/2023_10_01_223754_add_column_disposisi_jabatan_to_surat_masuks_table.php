<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDisposisiJabatanToSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->string('disposisi_jabatan')->nullable();
            $table->string('catatan_tindak_lanjut')->nullable();
            $table->string('tindakan_segera')->nullable();
            $table->string('tindakan_biasa')->nullable();
            
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
            $table->string('disposisi_jabatan')->nullable();
            $table->string('catatan_tindak_lanjut')->nullable();
            $table->string('tindakan_segera')->nullable();
            $table->string('tindakan_biasa')->nullable();
            
        });
    }
}
