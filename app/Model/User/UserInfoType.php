<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class UserInfoType extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_info_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'name',
    ];

    public function items() {
        return $this->hasMany(\App\Model\User\UserInfoOption::class, 'type_id', 'id');
    }
}
