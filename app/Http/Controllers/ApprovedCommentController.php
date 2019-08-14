<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class ApprovedCommentController extends Controller
{
    public function store(Comment $comment){

    	$comment->approved();

    	return back();
    }

    public function destroy(Comment $comment){

    	$comment->unapproved();
    	
    	return back(); 
    }
}
