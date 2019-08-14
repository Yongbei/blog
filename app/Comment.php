<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [
		'user_id',
		'post_id',
		'is_active',
		'body',
	];

	public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function commentReplies(){
        return $this->hasMany('App\CommentReply');
    }

    public function approved($approve = true){
        return $this->update(['is_active'=>$approve]);
    }

    public function unapproved(){
       $this->approved(false);
    }
}
