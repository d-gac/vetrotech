<?php

namespace App\Traits;

trait SygnaturyRekordu
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id;
        });

        static::creating(function ($model) {
            $model->updated_by = auth()->user()->id;
            $model->created_by = auth()->user()->id;
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->user()->id;
            $model->save();
        });
    }
}
