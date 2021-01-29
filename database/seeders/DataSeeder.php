<?php

namespace Database\Seeders;

use App\Models\Data;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Data::factory()
            ->has(Image::factory()->count(random_int(3, 5)), 'images')
            ->count(random_int(10, 15))
            ->create();
    }
}
