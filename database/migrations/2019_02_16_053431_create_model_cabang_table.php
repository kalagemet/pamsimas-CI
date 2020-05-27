<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cabang', function (Blueprint $table) {
            $table->increments('id',5);
            $table->string('nama_cabang',100)->unique();
            $table->string('alamat');
            $table->integer('id_admin')->unsigned();
            $table->string('no_tlp',50)->unique();
            $table->string('logo');
            $table->string('password');
            $table->string('remember_token');
            $table->boolean('active');
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
        Schema::dropIfExists('tbl_cabang');
    }
}
