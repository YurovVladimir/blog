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
            User::create([
                'name' => $this->faker->name,
                'email' =>$this->faker->email,
                'password' => $this->faker->password,
                'avatar' => $unsplash->random($params)->get()->urls->thumb,
            ]);
        }
    }
}
