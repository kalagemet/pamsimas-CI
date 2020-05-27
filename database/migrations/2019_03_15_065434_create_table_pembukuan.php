<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePembukuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembukuan', function (Blueprint $table) {
            $table->increments('id');
            $table->double('debet');
            $table->double('kredit');
            $table->double('saldo');
            $table->boolean('akses');
            $table->string('keterangan',100);
            $table->integer('id_cabang')->unsigned();
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
        Schema::dropIfExists('tbl_pembukuan');
    }
}
