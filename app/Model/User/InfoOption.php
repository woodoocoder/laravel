<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class InfoOption extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_info_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'name',
    ];
}
