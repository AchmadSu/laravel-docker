<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'genre_0001' => 'Action',
            'genre_0002' => 'Drama',
            'genre_0003' => 'Komedi',
            'genre_0004' => 'Thriller',
            'genre_0005' => 'Horror'
        ];

        foreach ($genres as $key => $value) {
            Genre::create([
                'code' => $key,
                'name' => $value
            ]);
        }
    }
}
