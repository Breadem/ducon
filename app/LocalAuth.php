<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LocalAuth extends Authenticatable
{	
	use Notifiable;
    //
    protected $table = 'local_auth';

    protected $fillable = [
        'phone', 'email', 'password','username','user_id'
    ];

    protected $hidden = [
        'id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
