<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'role', 'log_time'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    public $timestamps = false;

    public function local_auth()
    {
        return $this->hasOne('App\LocalAuth','user_id','id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return bool
     * 判断用户权限
     */

    public function isSuperAdmin()
    {
        return $this->role == 1;
    }
}
