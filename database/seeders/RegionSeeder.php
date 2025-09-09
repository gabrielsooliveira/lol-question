<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['name' => 'Águas de Sentina'],
            ['name' => 'Bandópolis'],
            ['name' => 'Demacia'],
            ['name' => 'Freljord'],
            ['name' => 'Ilhas das Sombras'],
            ['name' => 'Ionia'],
            ['name' => 'Ixtal'],
            ['name' => 'Noxus'],
            ['name' => 'Piltover'],
            ['name' => 'Shurima'],
            ['name' => "Targon"],
            ['name' => 'Vazio'],
            ['name' => 'Zaun']
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
