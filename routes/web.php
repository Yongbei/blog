<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/post/{slug}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::get('/post/{slug}', 'HomeController@post')->name('home.post');
Route::get('/category/{id}', 'HomeController@category')->name('home.category');

Route::group(['middleware'=>'admin'], function(){

	Route::get('/admin', 'AdminController@index')->name('admin.index');

	Route::resource('/admin/users', 'AdminUsersController');
	Route::resource('/admin/posts', 'AdminPostsController');
	// authorization 181213 執行上有問題,會擋住所有使用者
	// Route::resource('/admin/posts', 'AdminPostsController')->middleware('can:update,post');
	Route::resource('/admin/categories', 'AdminCategoriesController');

	Route::resource('/admin/media', 'AdminMediaController');
	Route::post('/admin/delete/media', 'AdminMediaController@deleteMedia');

	Route::resource('/admin/comments', 'PostCommentsController');
	Route::resource('/admin/comment/replies', 'CommentRepliesController');
	Route::post('/admin/comment/{comment}/approved', 'ApprovedCommentController@store');
	Route::delete('/admin/comment/{comment}/approved', 'ApprovedCommentController@destroy');
});

Route::group(['middleware'=>'auth'], function(){
	Route::post('/comment/reply', 'CommentRepliesController@createReply');
});







//================================ TEST ================================//



//========= Service Container and Auto-Resolution ========//
//========= Service Providers  ========//

// app() = resolve()

// use Illuminate\Filesystem\Filesystem;
// use App\Example;
use App\Services\Twitter;

// app()->bind()  &  app()->singleton()
// app()->singleton('example', function(){
// 	return new \App\Example;
// });
// app()->singleton('App\Example', function(){
// 	dd('called');
// 	return new \App\Example;
// });

Route::get('/container', function(Twitter $twitter){
	// dd(app(Filesystem::class));

	// dd(app('example'));
	// dd(app('example'), app('example'));
	// dd(app('App\Example'));

	// ServiceProvider 應用  (in SocialServiceProvider.php)
	dd($twitter);

});

//========= ./ Service Container and Auto-Resolution ========//


Route::get('/test', function(){
	$tasks = ['apple', 'blue', 'ddd'];
	$foo = 'footext';

	// return view('test')->withTasks($tasks)->withFoo($foo);

	// return view('test')->with([
	// 	'tasks' =>$tasks,
	// 	'foo'   =>$foo
	// ]);

	// return view('test', [
	// 	'tasks' =>$tasks,
	// 	'foo'   =>$foo
	// ]);

	// return view('test', compact('tasks', 'foo'));


	$post = \App\Post::all()->map->title;
	$post = \App\Post::all()[3];
	echo $post;

});


// middleware 應用
Route::get('/auth', 'HomeController@index')->middleware('auth');
Route::get('/signup-test', 'HomeController@index')->middleware('guest');




// notification 應用 181214
use App\Notifications\SubscriptionRenewalFailed;

Route::get('/notify', function(){
	$user = App\User::first();
	$user->notify(new SubscriptionRenewalFailed);

	return "notify done";
});





