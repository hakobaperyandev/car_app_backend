<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transmissionTypes = ['Manual', 'Automatic'];

        foreach ($transmissionTypes as $transmissionType) {
            Transmission::create(['type' => $transmissionType]);
        }
    }
}
