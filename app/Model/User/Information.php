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
        'living_id',
        'children_id',
        'smoking_id',
        'drinking_id',
    ];

    public function relationship() {
        return $this->hasOne(\App\Model\User\InfoOption::class, 'id', 'relationship_id');
    }

    public function living() {
        return $this->hasOne(\App\Model\User\InfoOption::class, 'id', 'living_id');
    }

    public function children() {
        return $this->hasOne(\App\Model\User\InfoOption::class, 'id', 'children_id');
    }

    public function smoking() {
        return $this->hasOne(\App\Model\User\InfoOption::class, 'id', 'smoking_id');
    }

    public function drinking() {
        return $this->hasOne(\App\Model\User\InfoOption::class, 'id', 'drinking_id');
    }

    
}