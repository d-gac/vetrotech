<?php

namespace App\Traits;

trait SygnaturyRekordu
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->updated_by = 44;
        });

        static::creating(function ($model) {
            $model->updated_by = 43;
            $model->created_by = 43;
        });

        static::deleting(function ($model) {
            $model->deleted_by = 45;
            $model->save();
        });
    }
}
