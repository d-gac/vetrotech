<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SygnaturyRekordu;

class Product extends Model
{
    use HasFactory, SoftDeletes, SygnaturyRekordu;

    public $guarded = [];

    public function order()
    {
        return $this->hasMany(Zamowienie::class);
    }
}
