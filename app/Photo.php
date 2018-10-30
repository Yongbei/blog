<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'path'];

    protected $upload_dir = '/images/';

    public function getNameAttribute($name){
    	return $this->upload_dir . $name;
    }
}
