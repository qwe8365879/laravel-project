<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
        'password', 'remember_token',
    ];

    /**
     * The UserGroup Objects that linked with this user
     * 
     * @return UserGroup[]
     */
    public function userGroups(){
        return $this->belongsToMany(Model\UserGroup::class);
    }

    public function isAdmin(){
        foreach($this->userGroups as $userGroup){
            if($userGroup->id == 1) return true;
        }
        return false;
    }

    public function articles(){
        return $this->hasMany(App\Model\Article::class, 'author_id', 'id');
    }
}
