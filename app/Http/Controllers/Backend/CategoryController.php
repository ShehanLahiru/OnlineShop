<?php

namespace App\Http\Controllers\Backend;

use App\Category;
// use App\Http\Requests\CMS\RiddleCreateRequest;
// use App\Http\Requests\CMS\RiddleUpdateRequest;
use App\ItemCategory;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackendRequest\CreateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ItemCategory::paginate(10);
        return view('backend.pages.categories.index',["categories"=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new ItemCategory();
        $category->name = $request->input("name");

        $result = $category->save();
        if ($result) {
            return redirect()->route('backend.categories.index')->with(session()->flash('success', 'category Created!'));
        } else {
            return redirect()->route('backend.categories.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ItemCategory::find($id);
        return view('backend.pages.categories.edit',["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id)
    {
        $category = ItemCategory::find($id);
        $category->name = $request->input("name");

        $result = $category->save();
        if ($result) {
            return redirect()->route('backend.categories.index')->with(session()->flash('success', 'category Updated!'));
        } else {
            return redirect()->route('backend.categories.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ItemCategory::find($id)->delete();
        if ($result) {
            return redirect()->route('backend.categories.index')->with(session()->flash('success', 'category Deleted!'));
        } else {
            return redirect()->route('backend.categories.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }
}
