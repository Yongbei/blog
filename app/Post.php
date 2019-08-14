<?php

namespace App;

use App\Events\PostCreated;
use App\Mail\PostCreated as PostCreatedMail;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = ['user_id', 'category_id', 'photo_id', 'title', 'body'];

    // 190610 marked by Yong
    // protected $dispatchesEvents = [
    //     'created' => PostCreated::class,
    // ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source'   => 'title',
                'onUpdate' => true,
            ]
            
        ];
    }

    //Model Hooks and Seesaws   181213 Yong
    // protected static function boot(){
    //     parent::boot();
    //     static::created(function($post){
    //         Mail::to($post->user->email)->send(
    //             new PostCreatedMail($post)
    //         );
    //     });
    // }
	

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function photo(){
    	return $this->belongsTo('App\Photo');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function photoPlaceholder(){
        return "http://placehold.it/900x300";
    }
}
