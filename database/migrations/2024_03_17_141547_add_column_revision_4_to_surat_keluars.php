<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRevision4ToSuratKeluars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_keluars', function (Blueprint $table) {
            $table->text('untuk')->nullable();
            $table->text('penutup')->nullable();
            $table->string('hari')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('waktu')->nullable();
            $table->text('tempat')->nullable();
            $table->text('alamat')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_keluars', function (Blueprint $table) {
            $table->dropColumn('untuk');
            $table->dropColumn('penutup');
            $table->dropColumn('hari');
            $table->dropColumn('tanggal');
            $table->dropColumn('waktu');
            $table->dropColumn('tempat');
            $table->dropColumn('alamat');
            $table->dropColumn('catatan');
        });
    }
}
