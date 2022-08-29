<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([   
            // Appetizer        
            [
                'category_id' => 1,
                'user_id' => 1,
                'name' => 'Chicharon',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 1,
                'user_id' => 1,
                'name' => 'Fresh Lumpia',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 1,
                'user_id' => 1,
                'name' => 'Lumpia Shanghai',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Main Course
            [
                'category_id' => 2,
                'user_id' => 1,
                'name' => 'Filipino Beef Steak',
                'description' => 'Filipino Beef Steak',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'name' => 'Lechon Baboy',
                'description' => 'Lechon Baboy',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'name' => 'Beef Kare-Kare',
                'description' => 'Beef Kare-Kare',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Dessert
            [
                'category_id' => 3,
                'user_id' => 1,
                'name' => 'Ice Cream',
                'description' => 'Ice Cream',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 3,
                'user_id' => 1,
                'name' => 'Black Forest Cake',
                'description' => 'Black Forest Cake',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 3,
                'user_id' => 1,
                'name' => 'Leche Flan',
                'description' => 'Leche Flan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Beverage
            [
                'category_id' => 4,
                'user_id' => 1,
                'name' => 'Soft Drinks',
                'description' => 'Soft Drinks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 4,
                'user_id' => 1,
                'name' => 'Iced Tea',
                'description' => 'Iced Tea',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 4,
                'user_id' => 1,
                'name' => 'Beer',
                'description' => 'Beer',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        Item::insert([   
            // Appetizer        
            [
                'category_id' => 5,
                'user_id' => 12,
                'name' => 'Chicharon',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 5,
                'user_id' => 12,
                'name' => 'Fresh Lumpia',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 5,
                'user_id' => 12,
                'name' => 'Lumpia Shanghai',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Main Course
            [
                'category_id' => 6,
                'user_id' => 12,
                'name' => 'Filipino Beef Steak',
                'description' => 'Filipino Beef Steak',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 6,
                'user_id' => 12,
                'name' => 'Lechon Baboy',
                'description' => 'Lechon Baboy',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 6,
                'user_id' => 12,
                'name' => 'Beef Kare-Kare',
                'description' => 'Beef Kare-Kare',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Dessert
            [
                'category_id' => 7,
                'user_id' => 12,
                'name' => 'Ice Cream',
                'description' => 'Ice Cream',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 7,
                'user_id' => 12,
                'name' => 'Black Forest Cake',
                'description' => 'Black Forest Cake',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 7,
                'user_id' => 12,
                'name' => 'Leche Flan',
                'description' => 'Leche Flan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Beverage
            [
                'category_id' => 8,
                'user_id' => 12,
                'name' => 'Soft Drinks',
                'description' => 'Soft Drinks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 8,
                'user_id' => 12,
                'name' => 'Iced Tea',
                'description' => 'Iced Tea',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 8,
                'user_id' => 12,
                'name' => 'Beer',
                'description' => 'Beer',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
