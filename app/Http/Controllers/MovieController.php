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
        MovieResponseTransformer $transformer,
        MovieFindParams $findParams
    ) {
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
