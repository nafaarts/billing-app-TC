<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 5; $i++) {
            Client::create([
                'company_name' => $faker->company(),
                'company_address' => $faker->address(),
                'company_npwp' => "999-99-9999999-9",
                'company_departement' => "Account Departement"
            ]);
        }
    }
}
