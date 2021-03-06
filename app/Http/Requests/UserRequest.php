<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email|max:255',
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#@%]).*$/', 'confirmed'],
        ],
        self::METHOD_PUT => [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255',
            'password' => 'required|confirmed',
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
            'name.max' => 'Pole nazwa może maksymalnie zawierać 255 znaków',
            'email.required' => 'Pole Email jest wymagane',
            'email.regex' => 'Pole Email musi być podobne do example@com.pl',
            'email.max' => 'Ten Email może maksymalnie zawierać 255 znaków',
            'email.unique' => 'Ten Email już jest zajęty',
            'password.required' => 'Pole Hasło jest wymagane',
            'password.confirmed' => 'Hasła się nie zgadzają',
            'password.regex' => 'Hasło jest zbyt łatwe. Aby wzmocnić siłę hasła dodaj brakujące elementy: wielką literę (A – Z), małą literę (a – z), cyfrę (0 - 9), znak specjalny (np. !, @, #)',
            'password.min' => 'Hasło musi zawierać conajmniej 6 znaków',
        ];
    }
}
