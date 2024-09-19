<?php

namespace Database\Seeders;

use App\Models\Engine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enngineTypes = ['Hybrid', 'Petrol', 'Diesel'];
        
        foreach ($enngineTypes as $engineType) {
            Engine::create(['type' => $engineType]);
        }

    }
}
