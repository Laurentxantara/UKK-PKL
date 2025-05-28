<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('siswa')->insert([
            [
                'nama' => 'Abu Bakar Tsabit Ghufron',
                'nis' => '20202',
                'email' => 'tsabit@cihuy.com',
                'gender' => 'L',
                'kontak' => '085971765038',
                'alamat' => 'Jl. Magelang No.144, Karangwaru, Kec. Tegalrejo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55241',
                'status_pkl' => 'kosong',
                'created_at' => now(),
                'updated_at' => now(),
            ],

         ]);
    }
}
