<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user admin seed
        DB::table('tbl_admin')->insert([
            'id' => 33001,
            'nama' => "asd",
            'password' => '$2y$10$bryPYhdlgDujClvHyj5Sru1SytqXpShcKERkh6DpVwU90Pw9dTi7u',
            'desa' => 3304130007,
            'kecamatan' => 3304130,
            'kabupaten' => 3304,
            'propinsi' => 33,
            'remember_token' => "",
            'foto' => "-",
            'nik' => "330413120198",
            'created_at'=> \Carbon\Carbon::now('Asia/Jakarta')
        ]);

        //user cabang seed
        DB::table('tbl_cabang')->insert([
            'id' => 19001,
            'nama_cabang' => "Tirta Lestari",
            'id_admin' => 33001,
            'alamat' => "-",
            'no_tlp' => "0",
            'logo' => "-",
            'password' => '$2y$10$bryPYhdlgDujClvHyj5Sru1SytqXpShcKERkh6DpVwU90Pw9dTi7u',
            'remember_token' => "",
            'active' => true,
            'created_at'=> \Carbon\Carbon::now('Asia/Jakarta')
        ]);

        DB::table('tbl_kebijakan')->insert([
            'id' => 20001,
            'id_cabang' => 19001,
            'tarif' => 1000,
            'penalti' => 1000,
            'created_at'=> \Carbon\Carbon::now('Asia/Jakarta')
        ]);
    }
}