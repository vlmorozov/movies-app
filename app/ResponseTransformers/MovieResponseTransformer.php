<?php

namespace App\ResponseTransformers;

use App\Helpers\TextCutter;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class MovieResponseTransformer implements ResponseTransformerInterface
{
    private const DATE_FORMAT = "d.m.Y";

    public function __construct(
        private TextCutter $textCutter,
    ) {
    }

    public function one(Movie $movie): array
    {
        return [
            'title' => $movie->title,
            'description' => $movie->description,
            'release_date' => $movie->release_date->format(self::DATE_FORMAT),
            'genres' => $movie->genres->pluck('name'),
        ];
    }

    public function list(Collection|array $movies): array
    {
        $result = [];

        foreach ($movies as $movie) {
            $result[] = [
                'title' => $movie->title,
                'description' => $this->textCutter->short($movie->description),
                'release_date' => $movie->release_date->format(self::DATE_FORMAT),
                'genres' => $movie->genres->pluck('name'),
            ];
        }

        return $result;
    }
}
