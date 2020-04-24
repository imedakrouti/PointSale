<?php

namespace App\Http\Controllers\dashboard;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories=category::select('id')->with('products')->when($request->table_search, function ($query) use ($request) {
                return $query->whereTranslationLike('name', '%' . $request->table_search . '%');
        })->when($request->date, function($query) use ($request) {
            return $query->where('created_at','like',"%{$request->date}%");
        })->latest()->paginate(5);

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

        //toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
        //alert('aaaaaaaaaaaaaa','success');
        return redirect('dashboard/category')->with('success', __('site.added_successfully'));
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
