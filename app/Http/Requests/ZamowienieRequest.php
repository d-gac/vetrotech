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
            'product_id' => 'required|integer|exists:products,id,deleted_at,NULL',
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
            'comments' => 'string|min:5|max:255',
        ],
        self::METHOD_PUT => [
            'orderNumber' => 'string|min:3',
            'admissionDate' => 'required|date',
            'receiptDate' => 'required|date',
            'product_id' => 'required|integer|exists:products,id,deleted_at,NULL',
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
            'comments' => 'string|min:5|max:255',
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
            'orderNumber.string' => 'Pole Numer zamówienia musi zawierać tekst',
            'orderNumber.min' => 'Pole Numer zamówienia musi składać się z conajmniej 3 znaków',

            'admissionDate.required' => 'Pole Data przyjęcia zamówienia jest wymagane',
            'admissionDate.date' => 'Pole Data przyjęcia zamówienia musi być formatu daty',

            'receiptDate.required' => 'Pole Termin odbioru jest wymagane',
            'receiptDate.date' => 'Pole Termin odbioru musi być formatu daty',

            'product_id.required' => 'Pole Produkt jest wymagane',
            'product_id.integer' => 'Pole Produkt musi zawierać wartość liczbową',
            'product_id.exists' => 'Produkt o takim ID nie istnieje',

            'contractor_id.required' => 'Pole Kontrahent jest wymagane',
            'contractor_id.integer' => 'Pole Kontrahent musi zawierać wartość liczbową',
            'contractor_id.exists' => 'Kontrahent o takim ID nie istnieje',

            'dimensions_id.required' => 'Pole Wymiary jest wymagane',
            'dimensions_id.integer' => 'Pole Wymiary musi zawierać tekst',
            'dimensions_id.exists' => 'Wymiar o takim ID nie istnieje lub jest obecnie niedostępny',

            'width.required' => 'Pole Szerokość jest wymagane',
            'width.integer' => 'Pole Szerokość musi zawierać wartość liczbową',
            'width.gt' => 'Pole Szerokość musi zawierać wartość liczbową dodatnią',

            'height.required' => 'Pole Wysokość jest wymagane',
            'height.integer' => 'Pole Wysokość musi zawierać wartość liczbową',
            'height.gt' => 'Pole Wysokość musi zawierać wartość liczbową dodatnią',

            'thickness.required' => 'Pole Grubość jest wymagane',
            'thickness.integer' => 'Pole Grubość musi zawierać wartość liczbową',
            'thickness.gt' => 'Pole Grubość musi zawierać wartość liczbową dodatnią',

            'typeOfGlass_id.required' => 'Pole Szkło jest wymagane',
            'typeOfGlass_id.integer' => 'Pole Szkło musi zawierać wartość liczbową',
            'typeOfGlass_id.exists' => 'Szkło o takim ID nie istnieje lub jest obecnie niedostępny',

            'nameOfGlass_id.required' => 'Pole Nazwa szkła jest wymagane',
            'nameOfGlass_id.integer' => 'Pole Nazwa szkła musi zawierać wartość liczbową',
            'nameOfGlass_id.exists' => 'Nazwa szkła o takim ID nie istnieje lub jest obecnie niedostępny',

            'treatment.required' => 'Pole Obróbka jest wymagane',
            'treatment.string' => 'Pole Obróbka musi zawierać tekst',
            'treatment.min' => 'Pole Obróbka musi składać się z conajmniej 3 znaków',
            'treatment.max' => 'Pole Obróbka może zawierać maksymalnie 255 znaków',

            'quantity.required' => 'Pole Ilość jest wymagane',
            'quantity.integer' => 'Pole Ilość musi zawierać wartość liczbową',
            'quantity.gt' => 'Pole Ilość musi zawierać wartość liczbową dodatnią',

            'amount.required' => 'Pole Kwota jest wymagane',
            'amount.numeric' => 'Pole Kwota musi zawierać wartość liczbową z separatorem "."',
            'amount.regex' => 'Pole Kwota musi zawierać wartość liczbową z dwoma miejscami po "."',
            'amount.gt' => 'Pole Kwota musi zawierać wartość liczbową dodatnią',

            'numberDepartment_id.required' => 'Pole Dział jest wymagane',
            'numberDepartment_id.integer' => 'Pole Dział musi zawierać wartość liczbową',
            'numberDepartment_id.exists' => 'Dział o takim ID nie istnieje lub jest obecnie niedostępny',

            'comments.string' => 'Pole Uwagi musi zawierać tekst',
            'comments.min' => 'Pole Uwagi musi składać się z conajmniej 5 znaków',
            'comments.max' => 'Pole Uwagi może zawierać maksymalnie 255 znaków',
        ];
    }
}
