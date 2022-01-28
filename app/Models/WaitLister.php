<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitLister extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wait_listers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fullname',
        'email',
        'type',
        'asset_description',
    ];


    public static function boot()
    {

        parent::boot();

        self::creating(function ($model) {

            $model->created_at = now();
            $model->updated_at = now();
        });
    }
}