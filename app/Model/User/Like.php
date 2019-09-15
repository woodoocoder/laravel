<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Like extends Model {
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'seen'
    ];


    public function user_from() {
        return $this->hasOne(User::class, 'id', 'user_id_from');
    }

    public function user_to() {
        return $this->hasOne(User::class, 'id', 'user_id_to');
    }
    
}
