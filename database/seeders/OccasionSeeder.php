<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Occasion;

class OccasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occasion::insert([
            [
                'name' => 'BIRTHDAY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'WEDDING',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PARTY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DEBUT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'GRADUATION',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ANNIVERSARY',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
