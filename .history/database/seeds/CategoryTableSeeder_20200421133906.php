<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['catone','catetwo','catthree'];
        foreach ($categories as $category) {
            App\Category::create([
                'name'=>$category
            ]);
        }

    }
}
