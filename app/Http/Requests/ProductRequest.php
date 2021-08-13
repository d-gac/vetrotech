<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * @var array
     */
    private static $rules = [
        self::METHOD_GET => [
            'itemsPerPage' => 'integer|min:1|max:50',
            'page' => 'integer|min:1',
            'id' => 'array|min:1',
            'id.*' => 'integer|min:1',
            'order.id' => 'string|in:asc,desc'
        ],
        self::METHOD_POST => [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'status' => 'required|boolean',
        ],
        self::METHOD_PUT => [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'status' => 'required|boolean',
        ],
        self::METHOD_DELETE => [
            'powod' => 'required|string',
        ],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::$rules[$this->getMethod()] ?? [];
    }
    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane',
            'name.string' => 'Pole nazwa musi zawierać tekst',
            'name.min' => 'Pole nazwa musi składać się z conajmniej 3 znaków',
            'description.required' => 'Pole Opis jest wymagane',
            'description.string' => 'Pole Opis musi zawierać tekst',
            'description.min' => 'Pole Opis musi składać się z conajmniej 10 znaków',
            'status.required' => 'Pole Status jest wymagane',
            'status.boolean' => 'Pole Status musi zawierać "0"/"1" lub 0/1',
        ];
    }
}
