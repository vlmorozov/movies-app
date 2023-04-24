<?php

namespace App\Http\Controllers;

use App\Params\MovieFindParams;
use App\ResponseTransformers\MovieResponseTransformer;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(

        MovieService $service,
        MovieResponseTransformer $transformer
    ) {
        /** @var MovieFindParams $findParams */
        $findParams = resolve(MovieFindParams::class);
        $findParams->setTitle('film 1');
        $findParams->setYear(2023);
        $findParams->setGenres([1,2]);

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
