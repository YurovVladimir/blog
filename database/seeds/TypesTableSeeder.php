<?php

use Illuminate\Database\Seeder;
use App\PostType;

class TypesTableSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       PostType::create([
           'name' => 'Научный'
       ]);
       PostType::create([
           'name' => 'Развлекательный'
       ]);
       PostType::create([
           'name' => 'Новостной'
       ]);
    }
}
