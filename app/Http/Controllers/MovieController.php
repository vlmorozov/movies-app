<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchMovieRequest;
use App\Params\MovieFindParams;
use App\ResponseTransformers\MovieResponseTransformer;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(
        SearchMovieRequest $request,
        MovieService $service,
        MovieResponseTransformer $transformer,
        MovieFindParams $findParams
    ) {
        $findParams
            ->setOffset((int)$request->get('offset', 0))
            ->setLimit((int)$request->get('limit', 10))
            ->setSearchQuery($request->get('searchQuery'))
            ->setYear($request->get('year'))
            ->setGenres($request->get('genres'));

        return response()->json(
            $transformer->list(
                $service->find($findParams)
            )
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id, MovieService $service, MovieResponseTransformer $transformer)
    {
        return response()->json(
            $transformer->one(
                $service->getOne($id)
            )
        );
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
