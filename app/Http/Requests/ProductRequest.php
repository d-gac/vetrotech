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
            'name' => 'required|string|min:3|max:255',
            'description' => 'string|min:10|max:65535',
            'status' => 'required|boolean',
        ],
        self::METHOD_PUT => [
            'name' => 'required|string|min:3|max:255',
            'description' => 'string|min:10|max:65535',
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
            'name.required' => 'Pole Nazwa jest wymagane',
            'name.string' => 'Pole Nazwa musi zawierać tekst',
            'name.min' => 'Pole Nazwa musi składać się z conajmniej 3 znaków',
            'name.max' => 'Pole Nazwa może maksymalnie zawierać 255 znaków',
            'description.string' => 'Pole Opis musi zawierać tekst',
            'description.min' => 'Pole Opis musi składać się z conajmniej 10 znaków',
            'description.max' => 'Pole Opis może maksymalnie zawierać 65535 znaków',
            'status.required' => 'Pole Status jest wymagane',
            'status.boolean' => 'Pole Status musi zawierać "0"/"1" lub 0/1',
        ];
    }
}
