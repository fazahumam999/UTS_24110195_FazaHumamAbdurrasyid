<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tamus')->insert([
            [
                'nama' => 'Ananda Tripadilah',
                'nomor_identitas' => '24110193',
                'alamat' => 'Jl. Merdeka No. 1, Bandung',
                'telepon' => '085794492247',
                'tanggal_checkin' => '2025-05-20',
                'tanggal_checkout' => '2025-05-23',
            ],
            [
                'nama' => 'Tendi Roy',
                'nomor_identitas' => '24110191',
                'alamat' => 'Jl. Asia Afrika No. 99, Bandung',
                'telepon' => '082114862573',
                'tanggal_checkin' => '2025-05-21',
                'tanggal_checkout' => '2025-05-22',
            ]
        ]);
    }
}
