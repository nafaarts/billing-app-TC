<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("id_ID");
        for ($i = 0; $i < 4; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('123123'),
                'level' => Arr::random(['AR', 'BL', 'SU']),
                'image' => 'sample.png',
            ]);
        }
    }
}
