<?php

namespace Database\Seeders;

use App\Models\Bank;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
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
            Bank::create([
                'bank_name' => "PT. TRANS CONTINENT",
                'bank_detail' => $faker->creditCardType(),
                'bank_address' => $faker->address(),
                'bank_account_number' => $faker->creditCardNumber(),
                'bank_currency' => "Rupiah",
                'swift_code' => $faker->swiftBicNumber()
            ]);
        }
    }
}
