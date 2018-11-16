<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoCreateRequest;
use App\Photo;

class AdminMediaController extends Controller
{
    public function index(){
    	$photos = Photo::paginate(5);
    	return view('admin.media.index', compact('photos'));
    }

    public function create(){
    	return view('admin.media.create');
    }

    public function store(Request $request){
    	if ($file = $request->file('file')) {
    		$name = time() . $file->getClientOriginalName();
    		$file->move('images', $name);
    		Photo::create(['name'=>$name]);
    	}
    	return redirect('/admin/media');
    }

    public function destroy($id){
    	$photo = Photo::findOrFail($id);
    	unlink(public_path($photo->name));
    	$photo->delete();

    	return redirect('/admin/media');
    }

    public function deleteMedia(Request $request){

        $data = $request->all();
        if ($request->selectAction == 'delete') {
            $photos = Photo::findOrFail($request->chkAry);
            foreach ($photos as $photo) {
                $photo->delete();
            }
        }

        return redirect()->back();
    }
}
