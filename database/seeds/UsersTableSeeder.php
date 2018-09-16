<?php

use App\Models\User;

class UsersTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            'query' => 'avatar',
        ];
        $unsplash = new MahdiMajidzadeh\LaravelUnsplash\Photo();
        for ($i = 0; $i < 10; $i++) {
            $url = $unsplash->random($params)->get()->urls->thumb;
            $contents = file_get_contents($url);
            $file_name = str_random(20) . '.jpeg';
            \Storage::disk('public')->put($file_name, $contents);
            User::create([
                'name' => $this->faker->name,
                'email' =>$this->faker->email,
                'password' => $this->faker->password,
                'avatar' => $file_name,
            ]);
        }
    }
}
