<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=product::with('category')->paginate(5);
        return view('dashboard.product.index')->with(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=category::all();
        return view('dashboard.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $rules = [
            'category' => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];

        }//end of  for each

        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];

        $request->validate($rules);
        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product-images/' . $request->image->hashName()));



        }//end of if
      //  dd($product_data['category_id']);

        $product_data= [
            'ar' => [
                'name'       => ($request['ar']['name']),
                'description'       => ($request['ar']['description']),
            ],
            'en' => [
                'name'       => ($request['en']['name']),
                'description'       => ($request['en']['description']),
                        ],
         ];

         $product_data['purchase_price']=$request->purchase_price;
         $product_data['sale_price']=$request->sale_price;
         $product_data['stock']=$request->stock;
         $product_data['category_id']=$request->category;
         $product_data['image'] = $request->image->hashName();
      //  dd($product_data['purchase_price']);
        // product::create([
        //     'ar' => [
        //         'name'       => ($request['ar']['name']),
        //         'description'       => ($request['ar']['description']),
        //     ],
        //     'en' => [
        //         'name'       => ($request['en']['name']),
        //         'description'       => ($request['en']['description']),
        //                 ],
        //     'category_id'   =>$request->category,
        //     'image'         => $request->image->hashName(),
        //     'purchase_price'=>$request->purchase_price,
        //     'sale_price'=>$request->purchase_price,
        //     'stock'=>$request->purchase_price,

        // ]);
        //dd(gettype($product_data['category_id']));
        product::create($product_data);
        toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect(route('dashboard.product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image!='default.png'){
            storage::disk('public_path')->delete('/product-images/'.$product->image);
        }
        $product->delete();
        toast(__('site.deleted_successfully'),'success')->position('top','center')->background('#447');
        return  redirect()->back();
    }
}
