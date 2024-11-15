<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    // NOTE: THIS HAS TO RUN WITH LOOPING IN TERMINAL TO EXECUTE NORMALLY
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\City::factory(1)->create();
    }
}
