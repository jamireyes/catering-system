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
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'role' => 'ADMIN',
                'gender' => 'MALE',
                'address_1' => '722 JoannaBetter Living Sun Valley 1771',
                'address_2' => 'Paranaque City',
                'city' => 'Manila',
                'province' => 'Manila',
                'zipcode' => '7000',
                'phone_number' => '09171234567',
                'created_at' => now(),
                'updated_at' => now()
            ], 
        ];
        
        DB::table('users')->insert($users);
        User::factory()->count(50)->create();
    }
}
