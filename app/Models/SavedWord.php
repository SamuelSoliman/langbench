<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavedWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text_id',
        'word',
        'translation',
        'context_sentence',
    ];

    protected $hidden = [
        'search_vector',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function text()
    {
        return $this->belongsTo(Text::class);
    }
}
