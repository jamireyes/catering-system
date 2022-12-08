<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
            OccasionSeeder::class,
            PackageSeeder::class,
            CategoryRulesSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}
