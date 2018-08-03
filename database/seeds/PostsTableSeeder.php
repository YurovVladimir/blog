<?php

use App\User;
use App\PostType;

class PostsTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $users = User::take(10)->get();
        /** @var User $user */
        foreach ($users as $user){
            for ($i = 0; $i < 10; $i++){
                $user->posts()->create([
                    'name' => $this->faker->word(),
                    'description' => $this->faker->text($maxNbChars = 100),
                    'image' => $this->faker->imageUrl(500, 300, 'cats', true, 'Faker', true),
                    'post_type_id' => PostType::find(random_int(1,3))->id
                ]);
            }

        }
    }
}
