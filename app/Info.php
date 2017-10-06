<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'info';

    public $timestamps = false;

    protected $fillable = [
        'title', 'brief', 'content','img','read_count','like_count',
        'user_id','comment_id','topic_id',
    ];

    public function topic()
    {
    	return $this->belongsTo('App\Topic');
    }

    public function comment()
    {
    	return $this->hasMany('App\Comment');
    }

}
