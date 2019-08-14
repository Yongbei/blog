<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function posts(){
        return $this->hasMany(Post::class);
        // return $this->hasMany('App\Post');
    }

    public function isAdmin(){
        //administrator
        return ($this->role->id == 1 && $this->is_active == 1) ? true : false;
    }

    public function addPost($attribute){
        return $this->posts()->create($attribute);
    }


    //===== 181217 tinker 測試 colleciton filter 用法  =====//
    // public function isVerified(){
    //     return (bool) $this->email_verified_at;
    // }

    // public function isNotVerified(){
    //     return !$this->isVerified();
    // }
    // . ==============================//
}
