<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = "lessons";

    protected $fillable = [
        'code',
        'name',
        'desc'
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_lessons', 'lesson_id', 'module_id');
    }
}
