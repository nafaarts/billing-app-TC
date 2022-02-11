<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Items;
use App\Models\Services;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoices = Invoice::get();
        $faker = Faker::create('id_ID');
        foreach ($invoices as $invoice) {
            for ($i = 0; $i < 5; $i++) {
                Items::create([
                    'invoice_id' => $invoice->id,
                    'item_detail' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'price' => $faker->numberBetween($min = 1000000, $max = 90000000),
                    'quantity' => $faker->numberBetween(1, 20),
                    'services_id' => collect(Services::get())->map(function ($item) {
                        return $item->id;
                    })->random()
                ]);
            }
        }
    }
}
