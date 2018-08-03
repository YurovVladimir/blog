<?php

use App\User;

class UsersTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => $this->faker->name,
                'email' =>$this->faker->email,
                'password' => $this->faker->password
            ]);
        }
    }
}
