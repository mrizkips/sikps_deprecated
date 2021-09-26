<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMahasiswaAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedTinyInteger('jurusan_id')->after('jen_kel');
            $table->unsignedSmallInteger('kbb_id')->after('jurusan_id');

            $table->foreign('kbb_id')
                ->references('id')->on('kbb')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('jurusan_id')
                ->references('id')->on('jurusan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['kbb_id']);
            $table->dropForeign(['jurusan_id']);
            $table->dropColumn('kbb_id');
            $table->dropColumn('jurusan_id');
        });
    }
}
