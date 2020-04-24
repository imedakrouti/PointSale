<?php

use Illuminate\Database\Seeder;

class productTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products=['prod1','prod2','prod3'];
        foreach ($products as $key => $product) {
            # code...
            App\Product::create([
                'ar' =>['name'=>$product,'description'=>$product.'desc'],
                'en' =>['name'=>$product,'description'=>$product.'desc'],
                'purchase_price'=>100,
                'sale_price'=>150,
                ''=>150
                ]);
        }

    }
}
