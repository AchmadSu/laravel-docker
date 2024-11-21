<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = "modules";

    protected $fillable = [
        'code',
        'name',
        'desc'
    ];

    // public function valuations()
    // {
    //     return $this->belongsToMany(Valuation::class, 'id', 'module_id');
    // }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'module_lessons', 'module_id', 'lesson_id');
    }
}
