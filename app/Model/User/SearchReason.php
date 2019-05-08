<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class SearchReason extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_search_reasons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
