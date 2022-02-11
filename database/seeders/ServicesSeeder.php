<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['Trucking', 'Air-Freight', 'Sea-Freight'])->each(function ($item) {
            Services::create(['name' => $item]);
        });
    }
}
