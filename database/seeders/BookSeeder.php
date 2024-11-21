<?php

namespace Database\Seeders;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'code' => 'ISBN-0001',
                'title' => 'Garis Waktu',
                'year' => 2011,
                'volume' => '02',
                'author_id' => 1,
                'city_id' => 2,
                'publisher_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'ISBN-0002',
                'title' => 'Cinta Brontosaurus',
                'year' => 2009,
                'volume' => '01',
                'author_id' => 3,
                'city_id' => 4,
                'publisher_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'ISBN-0003',
                'title' => 'Jatuh dan Cinta',
                'year' => 2018,
                'volume' => '01',
                'author_id' => 2,
                'city_id' => 3,
                'publisher_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'ISBN-0004',
                'title' => 'Harry Potter and The Prisoner of Azkaban',
                'year' => 2001,
                'volume' => '',
                'author_id' => 4,
                'city_id' => 2,
                'publisher_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'ISBN-0005',
                'title' => 'The Lord of The Rings: The Two Thrones',
                'year' => 1988,
                'volume' => '05',
                'author_id' => 5,
                'city_id' => 4,
                'publisher_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
