<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kabupaten;

class CreateSeedersKabupaten extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            Kabupaten::create([
                'nama_kabupaten' => 'Jakarta Pusat',
                'id_provinsi' => 1,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Jakarta Selatan',
                'id_provinsi' => 1,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Serang',
                'id_provinsi' => 2,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Tangerang',
                'id_provinsi' => 2,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Cirebon',
                'id_provinsi' => 3,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Banjar',
                'id_provinsi' => 3,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Sukoharjo',
                'id_provinsi' => 4,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Klaten',
                'id_provinsi' => 4,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Nganjuk',
                'id_provinsi' => 5,
            ]);
            Kabupaten::create([
                'nama_kabupaten' => 'Kediri',
                'id_provinsi' => 5,
            ]);
        });
    }
}
