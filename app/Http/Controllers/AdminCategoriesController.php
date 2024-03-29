<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;
use App\Category;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //create and validate 方法1
        // Category::create($request->all());

        //create and validate 方法2
        // $attributes = request()->validate([
        //     'name' => ['required', 'min:3', 'max:10']
        // ]);
        Category::create($this->validateCategory());

        flash('The Category has been created !');
        // Session::flash('msg', 'The Category has been created !');

        return redirect('/admin/categories');
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
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, CategoryRequest $request)
    {
        // $category->update($request->all());
        $category->update($this->validateCategory());

        flash('The Category has been updated !');
        // Session::flash('msg', 'The Category has been updated !');

        return redirect('/admin/categories');
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

        flash('The Category has been deleted !');
        // Session::flash('msg', 'The Category has been deleted !');

        return redirect('/admin/categories');
    }


    // 181213
    public function validateCategory(){
        return request()->validate([
            'name' => ['required', 'min:3', 'max:10']
        ]);
    }
}
