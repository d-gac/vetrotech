<?php

namespace App\Traits;

trait SygnaturyRekordu
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id ?? null;
        });

        static::creating(function ($model) {
            $model->updated_by = auth()->user()->id ?? null;
            $model->created_by = auth()->user()->id ?? null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->user()->id ?? null;
            $model->save();
        });
    }
}
