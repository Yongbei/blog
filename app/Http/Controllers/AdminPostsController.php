<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\Photo;
use App\Category;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->All();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();

        $user = Auth::user();

        if ($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        Session::flash('post_msg', 'The post has been created !');

        return redirect('/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        // $post = Post::findOrFail($id);

        $input = $request->all();

        // $user = Auth::user();

        if ($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        // $post->update($input);
        Auth::user()->posts()->whereId($id)->first()->update($input);

        Session::flash('post_msg', 'The post has been updated !');

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        unlink(public_path($post->photo->name));

        $post->photo()->delete();

        $post->delete();

        Session::flash('post_msg', 'The post has been deleted !');

        return redirect('/admin/posts');
    }


}
