<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'source_language',
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where('user_id', auth()->id());
            }
        });
    }

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
