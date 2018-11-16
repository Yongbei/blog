<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'path'];

    protected $upload_dir = '/images/';

    public function getNameAttribute($name){
    	$path = (file_exists(public_path() . $this->upload_dir . $name)) ? $this->upload_dir . $name : "http://placehold.it/900x300";
    	return $path;

    	// return $this->upload_dir . $name;
    	 
    }
}
