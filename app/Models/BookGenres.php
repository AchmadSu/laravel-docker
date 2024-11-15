<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookGenres extends Model
{
    use HasFactory;

    protected $table = 'book_genres';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'genre_id'
    ];
}
