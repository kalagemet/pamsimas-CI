<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pel = [
            ['id' => 10001, 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
            [ 'nama' => 'ujicoba', 'id_cabang' => 19001, 'created_at' => \Carbon\Carbon::now('Asia/Jakarta')],
        ];
        foreach($pel as $i){
            DB::table('tbl_pelanggan')->insert($i);
        }
    }
}