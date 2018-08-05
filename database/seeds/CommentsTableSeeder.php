<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

class CommentsTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::get();
        $users = User::get();
        foreach ($posts as $post) {
            for ($i = 0; $i < rand(3, 10); $i++) {
                $post->comments()->create([
                    'text' => $this->faker->text($maxNbChars = 255),
                    'user_id' => $users->random()->id
                ]);
            }
        }
    }
}
