<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorLog extends Model
{
    use HasFactory;

    protected $table = "authors_log";

    protected $fillable = [
        'action',
        'action_date',
        'author_id',
        'user_id'
    ];
}
