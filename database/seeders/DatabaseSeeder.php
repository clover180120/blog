<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(5)->create();

        $users->each(function ($user) {
            $posts = Post::factory()->count(10)->create([
                'user_id' => $user->id,
            ]);

            $posts->each(function ($post) use ($user) {
                Comment::factory()->count(3)->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            });
        });
    }
}
