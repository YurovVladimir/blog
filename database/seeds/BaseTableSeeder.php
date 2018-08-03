<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class BaseTableSeeder extends Seeder
{
    /**
     * @var Factory
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create('ru_Ru');
    }
}
