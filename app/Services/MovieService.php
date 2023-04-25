<?php

namespace App\Services;

use App\Models\Movie;
use App\Params\MovieFindParams;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Expression;

class MovieService
{
    public function getOne(int $id): Movie
    {
        return Movie::find($id);
    }

    public function find(MovieFindParams $params): Collection
    {
        return Movie::query()
            ->when($params->getSearchQuery(), function (Builder $builder) use ($params) {
                $builder->where('title', 'like', '%' . $params->getSearchQuery() . '%');
            })
            ->when($params->getYear(), function (Builder $builder) use ($params) {
                $builder->where(new Expression('YEAR(release_date)'), $params->getYear());
            })
            ->when($params->getGenres(), function (Builder $builder) use ($params) {
                $builder->whereHas('genres', function (Builder $genreBuilder) use ($params) {
                    $genreBuilder->whereIn('id', $params->getGenres());
                });
            })
            ->offset($params->getOffset())
            ->limit($params->getLimit())
            ->get();
    }
}
