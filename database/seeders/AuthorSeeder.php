<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'fiersa@example.com' => 'Fiersa Besari',
            'boychandra@example.com' => 'Boy Chandra',
            'raditya.dika@example.com' => 'Raditya Dika',
            'jk.rowling@example.com' => 'JK. Rowling',
            'tolkien@example.com' => 'J.R.R. Tolkien'
        ];

        foreach ($genres as $key => $value) {
            Author::create([
                'email' => $key,
                'name' => $value
            ]);
        }
    }
}
