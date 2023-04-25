<?php

namespace App\Http\Requests;

use App\Services\GenreService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(GenreService $genreService): array
    {
        return [
            'offset' => [
                'integer',
                'min:0',
            ],
            'limit' => [
                'integer',
                'min:1',
            ],
            'searchQuery' => [
                'min:3',
                'max:255'
            ],
            'year' => [
                'integer',
                'min:1900'
            ],
            'genres' => [
                'nullable',
                'array',
                Rule::in($genreService->all()->pluck('id'))
            ],
        ];
    }
}
