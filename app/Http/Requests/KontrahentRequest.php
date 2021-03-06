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
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255',
            'comments' => 'string|min:3|max:65535',
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
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255',
            'comments' => 'string|min:3|max:65535',
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
            'type_id.integer' => 'Pole Typ musi zawiera?? warto???? liczbow??',
            'type_id.exists' => 'Typ kontrahenta o takim ID nie istnieje lub jest obecnie niedost??pny',

            'companyName.string' => 'Pole Nazwa firmy musi zawiera?? tekst',
            'companyName.min' => 'Pole Nazwa firmy musi sk??ada?? si?? z conajmniej 3 znak??w',
            'companyName.max' => 'Pole Nazwa firmy mo??e maksymalnie zawiera?? 255 znak??w',

            'lname.required' => 'Pole Nazwisko jest wymagane',
            'lname.string' => 'Pole Nazwisko musi zawiera?? tekst',
            'lname.min' => 'Pole Nazwisko musi sk??ada?? si?? z conajmniej 3 znak??w',
            'lname.max' => 'Pole Nazwisko mo??e maksymalnie zawiera?? 255 znak??w',

            'fname.required' => 'Pole Imi?? jest wymagane',
            'fname.string' => 'Pole Imi?? musi zawiera?? tekst',
            'fname.min' => 'Pole Imi?? musi sk??ada?? si?? z conajmniej 3 znak??w',
            'fname.max' => 'Pole Imi?? mo??e maksymalnie zawiera?? 255 znak??w',

            'location.required' => 'Pole Miejscowo???? jest wymagane',
            'location.string' => 'Pole Miejscowo???? musi zawiera?? tekst',
            'location.min' => 'Pole Miejscowo???? musi sk??ada?? si?? z conajmniej 3 znak??w',
            'location.max' => 'Pole Miejscowo???? mo??e maksymalnie zawiera?? 255 znak??w',

            'postalCode.required' => 'Pole Kod pocztowy jest wymagane',
            'postalCode.integer' => 'Pole Kod pocztowy musi zawiera?? warto???? liczbow??',
            'postalCode.digits' => 'Pole Kod pocztowy musi zawiera?? dok??adnie 5 cyfr',

            'street.string' => 'Pole Ulica musi zawiera?? tekst',
            'street.min' => 'Pole Ulica musi sk??ada?? si?? z conajmniej 3 znak??w',
            'street.max' => 'Pole Ulica mo??e maksymalnie zawiera?? 255 znak??w',

            'numberHouse.required' => 'Pole Nr budynku/domu jest wymagane',
            'numberHouse.string' => 'Pole Nr budynku/domu mo??e zawiera?? tekst',
            'numberHouse.max' => 'Pole Nr budynku/domu mo??e maksymalnie zawiera?? 255 znak??w',

            'numberApartment.string' => 'Pole Nr lokalu/mieszkania musi zawiera?? liczb?? z ewentualn?? liter?? np. 15A',
            'numberApartment.max' => 'Pole Nr lokalu/mieszkania mo??e maksymalnie zawiera?? 255 znak??w',

            'numberPhone.required' => 'Pole Telefon jest wymagane',
            'numberPhone.integer' => 'Pole Telefon musi zawiera?? warto???? liczbow??',
            'numberPhone.digits' => 'Pole Telefon musi sk??ada?? si?? z dok??adnie 9 znak??w',

            'email.required' => 'Pole Email jest wymagane',
            'email.regex' => 'Pole Email musi by?? podobne do example@com.pl',
            'email.max' => 'Pole Email mo??e maksymalnie zawiera?? 255 znak??w',

            'comments.string' => 'Pole Uwagi musi zawiera?? tekst',
            'comments.min' => 'Pole Uwagi musi sk??ada?? si?? z conajmniej 3 znak??w',
            'comments.max' => 'Pole Uwagi mo??e maksymalnie zawiera?? 65535 znak??w',
        ];
    }
}
