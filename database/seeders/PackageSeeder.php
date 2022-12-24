<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::insert([
            [
                'user_id' => 13, 
                'name' => 'Wedding Package A', 
                'pax' => 10, 
                'cost_price' => '5000.00',
                'price' => '10000.00', 
                'inclusion' => 'Speakers, Accommodation, Venue', 
                'occasion_id' => 2,
                'discount' => 10,
                'created_at' => '2022-08-26 06:27:32', 
                'updated_at' => '2022-08-26 06:27:32'
            ],
            [
                'user_id' => 13, 
                'name' => 'Wedding Package B', 
                'pax' => 20, 
                'cost_price' => '10000.00',
                'price' => '20000.00', 
                'inclusion' => 'Speakers, Accommodation, Venue', 
                'occasion_id' => 2,
                'discount' => NULL,
                'created_at' => '2022-08-26 06:28:03', 
                'updated_at' => '2022-08-26 06:28:03'
            ],
            [
                'user_id' => 13, 
                'name' => 'Wedding Package C', 
                'pax' => 30, 
                'cost_price' => '15000.00',
                'price' => '30000.00', 
                'inclusion' => 'Speakers, Accommodation, Venue', 
                'occasion_id' => 2,
                'discount' => NULL,
                'created_at' => '2022-08-26 06:30:28', 
                'updated_at' => '2022-08-26 06:30:28'
            ],        
            [
                'user_id' => 12, 
                'name' => 'Birthday Package A', 
                'pax' => 40, 
                'cost_price' => '20000.00',
                'price' => '40000.00', 
                'inclusion' => 'Speakers, Venue', 
                'occasion_id' => 1,
                'discount' => NULL,
                'created_at' => '2022-08-26 06:52:02', 
                'updated_at' => '2022-08-26 06:52:02'
            ],
            [
                'user_id' => 12, 
                'name' => 'Birthday Package B', 
                'pax' => 50, 
                'cost_price' => '25000.00',
                'price' => '50000.00', 
                'inclusion' => 'Speakers, Venue', 
                'occasion_id' => 1,
                'discount' => NULL,
                'created_at' => '2022-08-26 06:52:24',
                'updated_at' => '2022-08-26 06:52:24'
            ],
            [
                'user_id' => 12, 
                'name' => 'Birthday Package C', 
                'pax' => 60, 
                'cost_price' => '30000.00',
                'price' => '60000.00', 
                'inclusion' => 'Speakers, Venue', 
                'occasion_id' => 1,
                'discount' => NULL,
                'created_at' => '2022-08-26 06:52:47',
                'updated_at' => '2022-08-26 06:52:47'
            ],
            [
                'user_id' => 13, 
                'name' => 'Package A', 
                'pax' => 100, 
                'cost_price' => '50000.00',
                'price' => '100000.00', 
                'inclusion' => 'Speakers, Decorations, Venue',
                'occasion_id' => 3,
                'discount' => NULL,
                'created_at' => '2022-08-27 04:24:46', 
                'updated_at' => '2022-08-27 04:24:46'
            ]
        ]);
    }
}
