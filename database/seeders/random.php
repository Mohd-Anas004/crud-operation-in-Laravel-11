<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CrudModel;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class random extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            $filenames = [];

            // Create fake files
            for ($j = 0; $j < 3; $j++) {
                $filename = 'fake_image_' . $faker->unique()->numberBetween(1, 1000) . '.jpg';
                Storage::put('public/upload/' . $filename, $faker->image());
                $filenames[] = $filename;
            }


            CrudModel::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'address' => $faker->address,
                'qualification' => $faker->word,
                'file' => json_encode($filenames)
            ]);
        }
    }
}
