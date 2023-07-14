<?php

namespace Database\Seeders;

use App\Models\GiziBayi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GiziBayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'usia' => 6,
                'berat_badan' => 5.2,
                'tinggi_badan' => 60,
                'jenis_kelamin' => 'Laki-laki',
                'status_gizi' => 'Normal',
            ],
            [
                'usia' => 9,
                'berat_badan' => 7.1,
                'tinggi_badan' => 68,
                'jenis_kelamin' => 'Perempuan',
                'status_gizi' => 'Gizi Kurang',
            ],
            // Tambahkan data gizi bayi lainnya
        ];

        foreach ($data as $item) {
            GiziBayi::create($item);
        }
    }
}
