<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('industri')->insert([
            [
                'nama' => 'CV Karya Hidup Sentosa',
                'bidang_usaha' => 'Manufaktur Pertanian',
                'kontak' => '085971765038',
                'alamat' => 'Jl. Magelang No.144, Karangwaru, Kec. Tegalrejo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55241',
                'email' => 'khscik@cihuy.com',
                'website' => 'xymch.me',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Aksa DIgital Group',
                'bidang_usaha' => 'Pemasaran Internet',
                'kontak' => '085971765038',
                'alamat' => 'Jl. Wongso Permono No.26, Klidon, Sukoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'email' => 'aksalohya@gmail.com',
                'website' => 'aksa.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gamatechno Indonesia',
                'bidang_usaha' => 'Software dan Perangkat Lunak',
                'kontak' => '085971765038',
                'alamat' => 'Jl. Purwomartani, Karangmojo, Purwomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55571',
                'email' => 'gama@cihuy.com',
                'website' => 'gamatechno.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
