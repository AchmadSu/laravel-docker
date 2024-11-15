<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLog extends Model
{
    use HasFactory;

    protected $table = 'books_log';

    protected $fillable = [
        'user_id',
        'book_id',
        'action',
        'action_date'
    ];
}
