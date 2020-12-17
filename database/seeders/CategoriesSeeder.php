<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeding some categories
        $category1 = Category::create([
            'name' => 'Laravel'
        ]);
        $category2 = Category::create([
            'name' => 'Vue.js'
        ]);
        $category3 = Category::create([
            'name' => 'React.js'
        ]);
        $category4 = Category::create([
            'name' => 'WordPress'
        ]);
    }
}
