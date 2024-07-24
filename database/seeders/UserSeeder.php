<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@ecom.uz',
            'phone' => '+998901234567',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'first_name' => 'Setora',
            'last_name' => 'Qobilova',
            'email' => 'setora0877@gmail.com',
            'phone' => '+9999989998',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('editor');

        $user = User::create([
            'first_name' => 'Sanjar',
            'last_name' => 'Eshqobilov',
            'email' => 'sanja@gmail.com',
            'phone' => '+99999389998',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('shop-manager');

        $user = User::create([
            'first_name' => 'Jamila',
            'last_name' => 'Toirova',
            'email' => 'jamila@gmail.com',
            'phone' => '+9567389998',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('helpdesk-support');

        $user = User::create([
            'first_name' => 'Zafar',
            'last_name' => 'Qobilov',
            'email' => 'zafarqobilov@gmail.com',
            'phone' => '+998900123456',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('customer');


        $users = User::factory()->count(10)->create();
        foreach ($users as $user){
            $user->assignRole('customer');
        }
    }
}
