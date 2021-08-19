<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ZamowienieRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SygnaturyRekordu;

class Zamowienie extends Model
{
    use HasFactory, SoftDeletes, SygnaturyRekordu;

    public $guarded = [];


    public function contractor()
    {
        return $this->belongsTo(Kontrahent::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function dimensions()
    {
        return $this->belongsTo(Lexicon::class, 'dimensions_id', 'code_id')
            ->where('type', 'dimensions');
    }

    public function typeOfGlass()
    {
        return $this->belongsTo(Lexicon::class, 'typeOfGlass_id', 'code_id')
            ->where('type', 'typeOfGlass');
    }

    public function nameOfGlass()
    {
        return $this->belongsTo(Lexicon::class, 'nameOfGlass_id', 'code_id')
            ->where('type', 'nameOfGlass');
    }

    public function numberDepartment()
    {
        return $this->belongsTo(Lexicon::class, 'numberDepartment_id', 'code_id')
            ->where('type', 'numberDepartment');
    }

}
