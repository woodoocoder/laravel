<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Options extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gender',
        'birthday',
        'country_id',
        'region_id',
        'city_id',
    ];
}