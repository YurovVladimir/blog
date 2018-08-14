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
    public function run($params = [])
    {
        $users = User::take(10)->get();
        $unsplash = new MahdiMajidzadeh\LaravelUnsplash\Photo();
        /** @var User $user */
        foreach ($users as $user) {
            $user->posts()->create([
                'name' => $this->faker->word(),
                'description' => $this->faker->text($maxNbChars = 5000),
                //'image' => $this->faker->imageUrl(500, 300, 'cats', true, 'Faker', true),
                'image' => $unsplash->random($params)->get()->urls->small,
                'post_type_id' => PostType::find(random_int(1, 3))->id
            ]);


        }
    }
}
