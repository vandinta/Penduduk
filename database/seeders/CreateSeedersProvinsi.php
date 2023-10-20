<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Provinsi;

class CreateSeedersProvinsi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            Provinsi::create([
                'nama_provinsi' => 'DKI Jakarta'
            ]);
            Provinsi::create([
                'nama_provinsi' => 'Banten'
            ]);
            Provinsi::create([
                'nama_provinsi' => 'Jawa Barat'
            ]);
            Provinsi::create([
                'nama_provinsi' => 'Jawa Tengah'
            ]);
            Provinsi::create([
                'nama_provinsi' => 'Jawa Timur'
            ]);
        });
    }
}
