<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_filters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reason_id',
        'gender',
        'age_from',
        'age_to',
        'city_id'
    ];


    public function reason() {
        return $this->hasOne(\App\Model\User\SearchReason::class, 'id', 'reason_id');
    }
}