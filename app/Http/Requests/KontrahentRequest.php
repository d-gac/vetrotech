<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontrahentRequest extends FormRequest
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
            'type' => 'required|boolean',
            'companyName' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'fname' => 'required|string|min:3',
            'location' => 'string|min:3',
            'postalCode' => 'numeric|digits:5',
            'street' => 'string|min:3',
            'numberHouse' => 'string|min:1',
            'numberApartment' => 'string|min:1',
            'numberPhone' => 'required|numeric|digits:9',
            'email' => 'required|email',
            'comments' => 'string|min:3',
        ],
        self::METHOD_PUT => [
            'type' => 'required|boolean',
            'companyName' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'fname' => 'required|string|min:3',
            'location' => 'string|min:3',
            'postalCode' => 'numeric|digits:5',
            'street' => 'string|min:3',
            'numberHouse' => 'string|min:1',
            'numberApartment' => 'string|min:1',
            'numberPhone' => 'required|numeric|digits:9',
            'email' => 'required|email',
            'comments' => 'string|min:3',
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
            'type.required' => 'Pole Typ jest wymagane',
            'type.boolean' => 'Pole Typ musi zawierać "0"/"1" lub 0/1',

            'companyName.required' => 'Pole Nazwa firmy jest wymagane',
            'companyName.string' => 'Pole Nazwa firmy musi zawierać tekst',
            'companyName.min' => 'Pole Nazwa firmy musi składać się z conajmniej 3 znaków',

            'lname.required' => 'Pole Nazwisko jest wymagane',
            'lname.string' => 'Pole Nazwisko musi zawierać tekst',
            'lname.min' => 'Pole Nazwisko musi składać się z conajmniej 3 znaków',

            'fname.required' => 'Pole Imię jest wymagane',
            'fname.string' => 'Pole Imię musi zawierać tekst',
            'fname.min' => 'Pole Imię musi składać się z conajmniej 3 znaków',

            'location.string' => 'Pole Miejscowość musi zawierać tekst',
            'location.min' => 'Pole Miejscowość musi składać się z conajmniej 3 znaków',

            'postalCode.numeric' => 'Pole Kod pocztowy musi zawierać wartość liczbową',
            'postalCode.digits' => 'Pole Kod pocztowy musi zawierać dokładnie 5 cyfr',

            'street.string' => 'Pole Ulica musi zawierać tekst',
            'street.min' => 'Pole Ulica musi składać się z conajmniej 3 znaków',

            'numberHouse.string' => 'Pole Nr budynku/domu musi zawierać tekst',
            'numberHouse.min' => 'Pole Nr budynku/domu musi składać się z conajmniej 1 znak',

            'numberApartment.string' => 'Pole Nr lokalu/mieszkania musi zawierać liczbę z ewentualną literą np. 15A',
            'numberApartment.min' => 'Pole Nr lokalu/mieszkania musi składać się z conajmniej 1 znak',

            'numberPhone.required' => 'Pole Telefon jest wymagane',
            'numberPhone.numeric' => 'Pole Telefon musi zawierać wartość liczbową',
            'numberPhone.digits' => 'Pole Telefon musi składać się z dokładnie 9 znaków',

            'email.required' => 'Pole Email jest wymagane',
            'email.email' => 'Pole Email musi być podobne do example@com.pl',

            'comments.string' => 'Pole Uwagi musi zawierać tekst',
            'comments.min' => 'Pole Uwagi musi składać się z conajmniej 3 znaków',
        ];
    }
}
