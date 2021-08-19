<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SygnaturyRekordu;

class Lexicon extends Model
{
    use HasFactory, SoftDeletes, SygnaturyRekordu;
    public $guarded = [];

    public function order()
    {
        return $this->hasOne(Zamowienie::class);
    }
}
