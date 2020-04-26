<?php

namespace App\Http\Controllers\dashboard;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories=category::select('id')->withCount('products')->when($request->table_search, function ($query) use ($request) {
                 $query->whereTranslationLike('name', '%' . $request->table_search . '%');
        })->when($request->date, function($query) use ($request) {
             $query->where('created_at','like',"%{$request->date}%");
        })->latest()->paginate(5);
        //dd($categories);
        /*
         $category=category::find(1);
        foreach ($category->products as $related) {
           # code...
       dd($related->sale_price);
       }
       $categories=category::has('products','>=',3)->paginate(3);
       $categories=category::has('products')->paginate(3);
       $categories=category::whereHas('products',function(builder $q){
           $q->where([['image','!=','default.png'],['stock','<','120']]);
       })->paginate(3);
       $categories=category::whereHas('products',function($query){
        $query->where('sale_price','>=',150);
    },'=',2)->oldest()->paginate(3);
    $categories=category::whereDoesntHave('products')->paginate();
    $categories=category::whereDoesntHave('products')->whereTranslationLike('name','catetwo')->paginate();
    $categories=category::whereDoesntHave('products',function(builder $q){
        $q->whereDate('created_at','2020-04-22');
    })->paginate(3);
    $categories=category::whereDate('created_at','2020-04-22')->paginate(5);
    $categories=category::wheretranslationLike('name','arabic')->paginate(5);
    $categories=category::wheredoesntHave('products',function($q){
        $q->whereBetween('stock',[120,130]);
    })->paginate(5);*/
        return view('dashboard.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);
        // $category_data = [
        //     'ar' => [
        //         'name'       => ($request['ar']['name']),
        //     ],
        //     'en' => [
        //         'name'       => ($request['en']['name']),
        //                 ],
        //  ];
        // dd($request['ar']['name']);
        $category_data=$request->all();
        category::create($category_data);
        //session()->flash('success', __('site.added_successfully'));

        toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
        //alert('aaaaaaaaaaaaaa','success');
        return redirect(route('dashboard.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];

        }//end of for each

        $request->validate($rules);
        $category_data = [
            'ar' => [
                'name'       => ($request['ar']['name']),
            ],
            'en' => [
                'name'       => ($request['en']['name']),
                        ],
         ];
        $category->update($category_data);
        toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect(route('dashboard.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        toast(__('site.deleted_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect()->back();
    }
}
