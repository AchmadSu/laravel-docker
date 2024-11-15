<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publisher = [
            'publisher_0001' => 'Erlangga',
            'publisher_0002' => 'Gramedia',
            'publisher_0003' => 'Mizan',
            'publisher_0004' => 'Agromedia',
            'publisher_0005' => 'Andi Publisher'
        ];

        foreach ($publisher as $key => $value) {
            Publisher::create([
                'code' => $key,
                'name' => $value,
                'city_id' => rand(1, 5)
            ]);
        }
    }
}
