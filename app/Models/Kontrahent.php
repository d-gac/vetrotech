<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\KontrahentRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SygnaturyRekordu;

class Kontrahent extends Model
{
    use HasFactory, SoftDeletes, SygnaturyRekordu;

    public $guarded = [];

    public function order()
    {
        return $this->hasMany(Zamowienie::class);
    }

    public function typeOfContractor()
    {
        return $this->belongsTo(Lexicon::class, 'type_id', 'code_id')
            ->where('type', 'contractorType');
    }
}
