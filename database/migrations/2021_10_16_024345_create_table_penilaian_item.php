<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenilaianItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_item', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('penilaian_id');
            $table->unsignedBigInteger('form_penilaian_item_id');
            $table->float('nilai')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('penilaian_id')
                ->references('id')->on('penilaian')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('form_penilaian_item_id')
                ->references('id')->on('form_penilaian_item')
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
        Schema::dropIfExists('penilaian_item');
    }
}
