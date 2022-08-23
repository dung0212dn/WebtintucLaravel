<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\AddCategoriesRequest;
use App\Models\Categories;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::paginate(15);
        return view('admin.categories.index')->with(compact('categories'));;
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
    public function store(AddCategoriesRequest $request)
    {
        $name = $request->input('name');
        $active = $request->input('active');

        $categories = new Categories();
        $categories->name = $name;
        $categories->active = $active;

        $categories->save();
        return redirect()->back()->with('msg', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::find($id);

        return view('admin.categories.show')->with(compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $active = $request->input('active');

        $categories = Categories::find($id);
        $categories->name = $name;
        $categories->active = $active;

        $categories->save();
        return redirect()->back()->with('msg', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $category = Categories::find($id);
        $category->delete();
        return redirect()->back()-> with('msg', "Xoá thành công người dùng");
    }
}
