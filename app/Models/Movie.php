<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 *  @property-read int $id
 *  @property string $title
 *  @property string $description
 *  @property Carbon $release_date
 *  @property-read Collection<Genre> $genres
 */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function genres(): HasManyThrough
    {
        return $this->hasManyThrough(
            Genre::class,
            GenreMovie::class,
            'movie_id',
            'id',
            'id',
            'genre_id',
        );
    }
}
