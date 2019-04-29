<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class User extends Authenticatable {
    use HasApiTokens, Notifiable;

    protected $dates = ['deleted_at'];

    protected $appends = ['avatar_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
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
    
    /**
    * Find the user instance for the given username.
    *
    * @param  string  $username
    * @return \App\User
    */
    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }

    public function getAvatarUrlAttribute() {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }
}
