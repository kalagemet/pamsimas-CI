<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTagihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tagihan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pelanggan')->unsigned();
            $table->double('jml_meter');
            $table->double('tarif');
            $table->double('denda');
            $table->boolean('lunas');
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
        Schema::dropIfExists('tbl_tagihan');
    }
}
