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
}
