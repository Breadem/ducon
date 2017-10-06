<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $table = 'topic';

    protected $fillable = [
        'name', 'head_img', 'back_img','brief','att_count','info_count',
    ];

    public function info()
    {
    	return $this->hasMany('App\Info','topic_id','id');
    }
}	
