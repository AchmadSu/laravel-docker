<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    use HasFactory;

    protected $table = "valuations";

    protected $fillable = [
        'user_id',
        'module_id',
        'lesson_id',
        'point'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
}
