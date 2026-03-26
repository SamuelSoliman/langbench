<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text_id',
        'data',
        'score',
        'completed_at',
    ];

    protected $casts = [
        'data' => 'array',
        'completed_at' => 'datetime',
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

    public function text()
    {
        return $this->belongsTo(Text::class);
    }
}
