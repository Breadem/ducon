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
     protected $dates = ['ctime',];


    public function topic()
    {
    	return $this->belongsTo('App\Topic');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    public function getComments()
    {
        return $this->comments->with('user')->get()->groupBy('parent_id');
    }

}
