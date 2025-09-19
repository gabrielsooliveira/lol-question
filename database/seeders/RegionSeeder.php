<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            [
                'id' => 1,
                'name' => 'Bilgewater'
            ],
            [
                'id' => 2,
                'name' => 'Bandle City'
            ],
            [
                'id' => 3,
                'name' => 'Demacia'
            ],
            [
                'id' => 4,
                'name' => 'Freljord'
            ],
            [
                'id' => 5,
                'name' => 'Shadow Isles'
            ],
            [
                'id' => 6,
                'name' => 'Ionia'
            ],
            [
                'id' => 7,
                'name' => 'Ixtal'
            ],
            [
                'id' => 8,
                'name' => 'Noxus'
            ],
            [
                'id' => 9,
                'name' => 'Piltover'
            ],
            [
                'id' => 10,
                'name' => 'Shurima'
            ],
            [
                'id' => 11,
                'name' => "Targon"
            ],
            [
                'id' => 12,
                'name' => 'Void'
            ],
            [
                'id' => 13,
                'name' => 'Zaun'
            ]
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
