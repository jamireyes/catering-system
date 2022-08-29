<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Three Catering Services',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'role' => 'ADMIN',
                'address_1' => '722 Joanna Street',
                'address_2' => 'Living Sun Valley',
                'city' => 'Paranaque City',
                'state' => 'Metro Manila',
                'zipcode' => '1700',
                'phone_number' => '09171234567',
                'created_at' => now(),
                'updated_at' => now()
            ], 
        ];
        
        DB::table('users')->insert($users);
        User::factory()->count(10)->create();
        
        for($x = 0; $x < 10; $x++){
            User::factory()->create([
                'name' => fake()->unique()->company(),
                'role' => 'SELLER'
            ]);
        }
    }
}
