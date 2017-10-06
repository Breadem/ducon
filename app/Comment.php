<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';


    protected $fillable = [
        'info_id', 'user_id', 'discusser_id','parent_id','level','upvotes',
        'downvotes','comment',
    ];

    public function info()
    {
    	return $this->belongsTo('App\Info');
    }

    public function user()
    {
    	return $this->belongsTo('App\User')
    				->select(['id','name','avatar']);
    }

    public function parent()
    {
    	return $this->belongsTo(slef::class,'parent_id');
    }
}
