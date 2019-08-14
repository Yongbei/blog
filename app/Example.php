<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $foo;

    public function __construct(Foo $foo){
    	$this->foo = $foo;
    }
}
