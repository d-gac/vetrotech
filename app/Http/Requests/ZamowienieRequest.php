<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZamowienieRequest extends FormRequest
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
            'orderNumber' => 'string|min:3',
            'admissionDate' => 'required|date',
            'receiptDate' => 'required|date',
            'product_id' => 'required|integer|exists:products,id,deleted_at,NULL,status,1',
            'contractor_id' => 'required|integer|exists:contractors,id,deleted_at,NULL',
            'dimensions_id' => 'required|integer|exists:lexicons,code_id,type,dimensions,status,1',
            'width' => 'required|gt:0|integer',
            'height' => 'required|gt:0|integer',
            'thickness' => 'required|gt:0|integer',
            'typeOfGlass_id' => 'required|integer|exists:lexicons,code_id,type,typeOfGlass,status,1',
            'nameOfGlass_id' => 'required|integer|exists:lexicons,code_id,type,nameOfGlass,status,1',
            'treatment' => 'required|string|min:3|max:255',
            'quantity' => 'required|gt:0|integer',
            'amount' => 'required|gt:0|numeric|regex:/^\d*(\.\d{2})?$/',
            'numberDepartment_id' => 'required|integer|exists:lexicons,code_id,type,numberDepartment,status,1',
            'comments' => 'string|min:5|max:65535',
        ],
        self::METHOD_PUT => [
            'orderNumber' => 'string|min:3',
            'admissionDate' => 'required|date',
            'receiptDate' => 'required|date',
            'product_id' => 'required|integer|exists:products,id,deleted_at,NULL,status,1',
            'contractor_id' => 'required|integer|exists:contractors,id,deleted_at,NULL',
            'dimensions_id' => 'required|integer|exists:lexicons,code_id,type,dimensions,status,1',
            'width' => 'required|gt:0|integer',
            'height' => 'required|gt:0|integer',
            'thickness' => 'required|gt:0|integer',
            'typeOfGlass_id' => 'required|integer|exists:lexicons,code_id,type,typeOfGlass,status,1',
            'nameOfGlass_id' => 'required|integer|exists:lexicons,code_id,type,nameOfGlass,status,1',
            'treatment' => 'required|string|min:3|max:255',
            'quantity' => 'required|gt:0|integer',
            'amount' => 'required|gt:0|numeric|regex:/^\d*(\.\d{2})?$/',
            'numberDepartment_id' => 'required|integer|exists:lexicons,code_id,type,numberDepartment,status,1',
            'comments' => 'string|min:5|max:65535',
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
            'orderNumber.string' => 'Pole Numer zam??wienia musi zawiera?? tekst',
            'orderNumber.min' => 'Pole Numer zam??wienia musi sk??ada?? si?? z conajmniej 3 znak??w',

            'admissionDate.required' => 'Pole Data przyj??cia zam??wienia jest wymagane',
            'admissionDate.date' => 'Pole Data przyj??cia zam??wienia musi by?? formatu daty',

            'receiptDate.required' => 'Pole Termin odbioru jest wymagane',
            'receiptDate.date' => 'Pole Termin odbioru musi by?? formatu daty',

            'product_id.required' => 'Pole Produkt jest wymagane',
            'product_id.integer' => 'Pole Produkt musi zawiera?? warto???? liczbow??',
            'product_id.exists' => 'Produkt o takim ID nie istnieje',

            'contractor_id.required' => 'Pole Kontrahent jest wymagane',
            'contractor_id.integer' => 'Pole Kontrahent musi zawiera?? warto???? liczbow??',
            'contractor_id.exists' => 'Kontrahent o takim ID nie istnieje',

            'dimensions_id.required' => 'Pole Wymiary jest wymagane',
            'dimensions_id.integer' => 'Pole Wymiary musi zawiera?? tekst',
            'dimensions_id.exists' => 'Wymiar o takim ID nie istnieje lub jest obecnie niedost??pny',

            'width.required' => 'Pole Szeroko???? jest wymagane',
            'width.integer' => 'Pole Szeroko???? musi zawiera?? warto???? liczbow??',
            'width.gt' => 'Pole Szeroko???? musi zawiera?? warto???? liczbow?? dodatni??',

            'height.required' => 'Pole Wysoko???? jest wymagane',
            'height.integer' => 'Pole Wysoko???? musi zawiera?? warto???? liczbow??',
            'height.gt' => 'Pole Wysoko???? musi zawiera?? warto???? liczbow?? dodatni??',

            'thickness.required' => 'Pole Grubo???? jest wymagane',
            'thickness.integer' => 'Pole Grubo???? musi zawiera?? warto???? liczbow??',
            'thickness.gt' => 'Pole Grubo???? musi zawiera?? warto???? liczbow?? dodatni??',

            'typeOfGlass_id.required' => 'Pole Szk??o jest wymagane',
            'typeOfGlass_id.integer' => 'Pole Szk??o musi zawiera?? warto???? liczbow??',
            'typeOfGlass_id.exists' => 'Szk??o o takim ID nie istnieje lub jest obecnie niedost??pny',

            'nameOfGlass_id.required' => 'Pole Nazwa szk??a jest wymagane',
            'nameOfGlass_id.integer' => 'Pole Nazwa szk??a musi zawiera?? warto???? liczbow??',
            'nameOfGlass_id.exists' => 'Nazwa szk??a o takim ID nie istnieje lub jest obecnie niedost??pny',

            'treatment.required' => 'Pole Obr??bka jest wymagane',
            'treatment.string' => 'Pole Obr??bka musi zawiera?? tekst',
            'treatment.min' => 'Pole Obr??bka musi sk??ada?? si?? z conajmniej 3 znak??w',
            'treatment.max' => 'Pole Obr??bka mo??e zawiera?? maksymalnie 255 znak??w',

            'quantity.required' => 'Pole Ilo???? jest wymagane',
            'quantity.integer' => 'Pole Ilo???? musi zawiera?? warto???? liczbow??',
            'quantity.gt' => 'Pole Ilo???? musi zawiera?? warto???? liczbow?? dodatni??',

            'amount.required' => 'Pole Kwota jest wymagane',
            'amount.numeric' => 'Pole Kwota musi zawiera?? warto???? liczbow?? z separatorem "."',
            'amount.regex' => 'Pole Kwota musi zawiera?? warto???? liczbow?? z dwoma miejscami po "."',
            'amount.gt' => 'Pole Kwota musi zawiera?? warto???? liczbow?? dodatni??',

            'numberDepartment_id.required' => 'Pole Dzia?? jest wymagane',
            'numberDepartment_id.integer' => 'Pole Dzia?? musi zawiera?? warto???? liczbow??',
            'numberDepartment_id.exists' => 'Dzia?? o takim ID nie istnieje lub jest obecnie niedost??pny',

            'comments.string' => 'Pole Uwagi musi zawiera?? tekst',
            'comments.min' => 'Pole Uwagi musi sk??ada?? si?? z conajmniej 5 znak??w',
            'comments.max' => 'Pole Uwagi mo??e maksymalnie zawiera?? 65535 znak??w',
        ];
    }
}
