<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	DB::table('users')->truncate();
    	DB::table('posts')->truncate();
    	DB::table('roles')->truncate();
    	DB::table('categories')->truncate();
    	DB::table('photos')->truncate();
    	DB::table('comments')->truncate();
    	DB::table('comment_replies')->truncate();

    	factory(App\User::class, 10)->create()->each(function($user){
    		$user->posts()->save(factory(App\Post::class)->make());
    	});

    	factory(App\Post::class, 10)->create();

    	factory(App\Role::class, 3)->create();

    	factory(App\Category::class, 3)->create();

    	factory(App\Photo::class, 10)->create();

    	// factory(App\Comment::class, 10)->create();

    	// factory(App\CommentReply::class, 10)->create();

        // 呼叫 UsersTableSeeder
        // $this->call(UsersTableSeeder::class);
    }
}
