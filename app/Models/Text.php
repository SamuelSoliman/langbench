<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'source_language',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savedWords()
    {
        return $this->hasMany(SavedWord::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
