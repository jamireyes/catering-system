<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert([
            [
                'user_id' => 2, 
                'package_id' => 7, 
                'created_at' => '2022-08-27 06:45:18', 
                'updated_at' => '2022-08-27 06:45:18', 
                'deleted_at' => NULL,
                'discount' => NULL,
                'status'=> 'PENDING',
                'subtotal' => '100000.00',
            ],
            [
                'user_id' => 2, 
                'package_id' => 6, 
                'created_at' => '2022-08-28 04:30:35', 
                'updated_at' => '2022-08-28 04:30:35', 
                'deleted_at' => NULL,
                'discount' => NULL,
                'status'=> 'PENDING',
                'subtotal' => '60000.00',
            ],
            [
                'user_id' => 3, 
                'package_id' => 7, 
                'created_at' => '2022-09-01 23:46:36',
                'updated_at' => '2022-09-01 23:46:36',
                'deleted_at' => NULL,
                'discount' => NULL,
                'status'=> 'PENDING',
                'subtotal' => '100000.00',
            ],
        ]);
          
    
    }
}
