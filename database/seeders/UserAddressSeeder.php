<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::find(2)->addresses()->create([
            "latitude" => "41.345678" ,
            "longitude" => "32.456432",
            "region" => "Tashkent",
            "district" => "olamzor",
            "street" => "Sebzor",
            "home" => "285"
        ]);

        User::find(2)->addresses()->create([
            "latitude" => "41.345678" ,
            "longitude" => "32.456432",
            "region" => "Tashkent",
            "district" => "olamzor",
            "street" => "Ganga",
            "home" => "278"
        ]);
    }
}
