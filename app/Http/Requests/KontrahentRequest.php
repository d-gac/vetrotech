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
            'type_id' => 'required|integer|exists:lexicons,code_id,type,contractorType,status,1',
            'companyName' => 'string|min:3|max:255',
            'lname' => 'required|string|min:3|max:255',
            'fname' => 'required|string|min:3|max:255',
            'location' => 'required|string|min:3|max:255',
            'postalCode' => 'required|integer|digits:5',
            'street' => 'string|min:3|max:255',
            'numberHouse' => 'required|string|max:255',
            'numberApartment' => 'string|max:255',
            'numberPhone' => 'required|integer|digits:9',
            'email' => 'required|email|max:255',
            'comments' => 'string|min:3|max:255',
        ],
        self::METHOD_PUT => [
            'type_id' => 'required|integer|exists:lexicons,code_id,type,contractorType,status,1',
            'companyName' => 'string|min:3|max:255',
            'lname' => 'required|string|min:3|max:255',
            'fname' => 'required|string|min:3|max:255',
            'location' => 'required|string|min:3|max:255',
            'postalCode' => 'required|integer|digits:5',
            'street' => 'string|min:3|max:255',
            'numberHouse' => 'required|string|max:255',
            'numberApartment' => 'string|max:255',
            'numberPhone' => 'required|integer|digits:9',
            'email' => 'required|email|max:255',
            'comments' => 'string|min:3|max:255',
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
            'type_id.required' => 'Pole Typ jest wymagane',
            'type_id.integer' => 'Pole Typ musi zawierać wartość liczbową',
            'type_id.exists' => 'Typ kontrahenta o takim ID nie istnieje lub jest obecnie niedostępny',

            'companyName.string' => 'Pole Nazwa firmy musi zawierać tekst',
            'companyName.min' => 'Pole Nazwa firmy musi składać się z conajmniej 3 znaków',
            'companyName.max' => 'Pole Nazwa firmy może maksymalnie zawierać 255 znaków',

            'lname.required' => 'Pole Nazwisko jest wymagane',
            'lname.string' => 'Pole Nazwisko musi zawierać tekst',
            'lname.min' => 'Pole Nazwisko musi składać się z conajmniej 3 znaków',
            'lname.max' => 'Pole Nazwisko może maksymalnie zawierać 255 znaków',

            'fname.required' => 'Pole Imię jest wymagane',
            'fname.string' => 'Pole Imię musi zawierać tekst',
            'fname.min' => 'Pole Imię musi składać się z conajmniej 3 znaków',
            'fname.max' => 'Pole Imię może maksymalnie zawierać 255 znaków',

            'location.required' => 'Pole Miejscowość jest wymagane',
            'location.string' => 'Pole Miejscowość musi zawierać tekst',
            'location.min' => 'Pole Miejscowość musi składać się z conajmniej 3 znaków',
            'location.max' => 'Pole Miejscowość może maksymalnie zawierać 255 znaków',

            'postalCode.required' => 'Pole Kod pocztowy jest wymagane',
            'postalCode.integer' => 'Pole Kod pocztowy musi zawierać wartość liczbową',
            'postalCode.digits' => 'Pole Kod pocztowy musi zawierać dokładnie 5 cyfr',

            'street.string' => 'Pole Ulica musi zawierać tekst',
            'street.min' => 'Pole Ulica musi składać się z conajmniej 3 znaków',
            'street.max' => 'Pole Ulica może maksymalnie zawierać 255 znaków',

            'numberHouse.required' => 'Pole Nr budynku/domu jest wymagane',
            'numberHouse.string' => 'Pole Nr budynku/domu może zawierać tekst',
            'numberHouse.max' => 'Pole Nr budynku/domu może maksymalnie zawierać 255 znaków',

            'numberApartment.string' => 'Pole Nr lokalu/mieszkania musi zawierać liczbę z ewentualną literą np. 15A',
            'numberApartment.max' => 'Pole Nr lokalu/mieszkania może maksymalnie zawierać 255 znaków',

            'numberPhone.required' => 'Pole Telefon jest wymagane',
            'numberPhone.integer' => 'Pole Telefon musi zawierać wartość liczbową',
            'numberPhone.digits' => 'Pole Telefon musi składać się z dokładnie 9 znaków',

            'email.required' => 'Pole Email jest wymagane',
            'email.email' => 'Pole Email musi być podobne do example@com.pl',
            'email.max' => 'Pole Email może maksymalnie zawierać 255 znaków',

            'comments.string' => 'Pole Uwagi musi zawierać tekst',
            'comments.min' => 'Pole Uwagi musi składać się z conajmniej 3 znaków',
            'comments.max' => 'Pole Uwagi może maksymalnie zawierać 255 znaków',
        ];
    }
}
