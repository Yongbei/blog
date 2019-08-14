<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\PostCreated;
use App\Http\Requests\PostsCreateRequest;
use App\Mail\PostCreated as PostCreatedMail;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class AdminPostsController extends Controller
{
    // authorization 181213  執行上有問題,會擋住所有使用者
    // public function __construct(){
    //     $this->middleware('can:update,post')->except(['index', 'edit']);
    // }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(10);
        // $posts = Post::where('user_id', auth()->id())->paginate(10);

        // Telescope test 181213
        // dump($posts);
        // cache()->rememberForever('status', function(){
        //     return ['lessions' => 1300, 'hours' => 500, 'series' => 100];
        // });
        // $status = cache()->get('status');
        // dump($status);

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
        $attribute = $request->all();

        $user = Auth::user();

        if ($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['name'=>$name]);
            $attribute['photo_id'] = $photo->id;
        }

        $post = $user->addPost($attribute);

        // 181214 mail寄送
        // Mail::to($post->user->email)->send(
        //     new PostCreatedMail($post)
        // );

        //=== Events & Listeners  181214 ===//
        // event(new PostCreated($post));


        flash('The post has been created !');

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


        //======= Authorization =======// 181212

        // if ($post->user_id !== auth()->id()) { abort(403); }

        // abort_if($post->user_id !== auth()->id(), 403);
        // abort_unless($post->user_id == auth()->id(), 403);
        // abort_if(!auth()->user()->owns($post), 403);
        // abort_unless(auth()->user()->owns($post), 403)

        $this->authorize('update', $post);  //執行Policy驗證

        // abort_if(\Gate::denies('update', $post), 403);
        // abort_unless(\Gate::allows('update', $post), 403);

        //======= ./ Authorization =======//

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

        flash('The post has been updated !');

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

        flash('The post has been deleted !');

        return redirect('/admin/posts');
    }


}
