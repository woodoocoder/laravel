<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Information extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_information';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'relationship_id',
        'sexuality_id',
        'appearance_id',
        'living_id',
        'children_id',
        'smoking_id',
        'drinking_id',
    ];
}