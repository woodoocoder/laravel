<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Woodoocoder\LaravelDialogs\Traits\Messagable;
use App\Model\User\Like;


class User extends Authenticatable {
    use HasApiTokens, Notifiable, Messagable;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'password',
        'avatar',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function options() {
        return $this->hasOne(\App\Model\User\Options::class);
    }

    public function information() {
        return $this->hasOne(\App\Model\User\Information::class);
    }

    public function filters() {
        return $this->hasOne(\App\Model\User\Filter::class);
    }
}
