<?php

use App\Models\User;
use App\Models\PostType;

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
        $params = [
            'query' => 'photo',
        ];
        $users = User::take(10)->get();
        $unsplash = new MahdiMajidzadeh\LaravelUnsplash\Photo();
        /** @var User $user */
        foreach ($users as $user) {
            $url = $unsplash->random($params)->get()->urls->small;
            $contents = file_get_contents($url);
            $file_name = str_random(20) . '.jpeg';
            \Storage::disk('public')->put($file_name, $contents);
            $user->posts()->create([
                'name' => $this->faker->word(),
                'description' => $this->faker->text($maxNbChars = 5000),
                //'image' => $this->faker->imageUrl(500, 300, 'cats', true, 'Faker', true),
                'image' => $file_name,
                'post_type_id' => PostType::find(random_int(1, 3))->id
            ]);


        }
    }
}
