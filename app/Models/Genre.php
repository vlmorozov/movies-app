<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function movies(): HasManyThrough
    {
        return $this->hasManyThrough(
            Movie::class,
            GenreMovie::class,
            'genre_id',
            'id',
            'id',
            'movie_id',
        );
    }
}
