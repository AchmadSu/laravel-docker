<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'code',
        'year',
        'volume',
        'author_id',
        'genre_id',
        'city_id',
        'publisher_id'
    ];
}
