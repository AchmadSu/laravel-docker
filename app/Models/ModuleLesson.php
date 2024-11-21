<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleLesson extends Model
{
    use HasFactory;

    protected $table = "module_lessons";

    protected $fillable = [
        'module_id',
        'lesson_id'
    ];
}
