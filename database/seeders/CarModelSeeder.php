<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Engine;
use App\Models\Transmission;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $brands = Brand::pluck('id')->toArray();

        $models = [
            [
                'exterior_color' => 'Red',
                'interior_color' => 'Black'
            ],
            [
                'exterior_color' => 'White',
                'interior_color' => 'Grey'
            ],
            [
                'exterior_color' => 'Blue',
                'interior_color' => 'Beige'
            ]
        ];

        foreach ($brands as $brandId) {
            foreach ($models as $model) {
                CarModel::create(array_merge(
                    $model,
                    [
                        'price'           =>  $faker->numberBetween(20000, 35000),
                        'year'            => $faker->numberBetween(2000, 2024),
                        'brand_id'        => $brandId,
                        'transmission_id' => Transmission::inRandomOrder()->first()->id,
                        'engine_id'       => Engine::inRandomOrder()->first()->id
                    ]
                ));
            }
        }
    }
}
