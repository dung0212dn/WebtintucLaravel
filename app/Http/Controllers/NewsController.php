<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\AddNewsRequest;
use App\Http\Requests\admin\UpdateNewsRequest;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('checkrole:admin')->except(['index', 'create', 'show']);
    }

    public function index()
    {
        $allnews = News::orderBy('created_at', 'DESC')->paginate(15);
        $authors = User::all();
        return view('admin.news.index')->with(compact(['allnews', 'authors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::where('active', 1)->get();
        return view('admin.news.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewsRequest $request)
    {
        $title = $request->input('title');
        $sumary = $request->input('sumary');
        $content = $request->input('content');
        $category = $request->input('category');
        $author = $request->input('author');

        $image = $request->file('image');
        $nameImg = time().'_'.$image->getClientOriginalName();
        $image->move('images', $nameImg);

        $news = new News();
        $news->title = $title;
        $news->sumary = $sumary;
        $news->content = $content;
        $news->category_id = $category;
        $news->author_id = $author;
        $news->picIntro = $nameImg;
        $news->active = 0;

        $news->save();

        return redirect()->back()->with('msg', 'Thêm bài viết thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('admin.news.show')->with(compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $categories = Categories::where('active', 1)->get();
        return view('admin.news.edit')->with(compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        $title = $request->input('title');
        $sumary = $request->input('sumary');
        $content = $request->input('content');
        $category = $request->input('category');
        $author = $request->input('author');
        $active = $request->input('active');

        $image = $request->file('image');
        $nameImg = time().'_'.$image->getClientOriginalName();
        $image->move('images', $nameImg);

        $news = News::find($id);
        $news->title = $title;
        $news->sumary = $sumary;
        $news->content = $content;
        $news->category_id = $category;
        $news->author_id = $author;
        $news->picIntro = $nameImg;
        $news->active = $active;

        $news->save();

        return redirect()->route('news.index')->with('msg', 'Cập nhật bài viết thành công');
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
        $news = News::find($id);
        $news->delete();
        return redirect()->back()-> with('msg', "Xoá thành công bài viết");
    }
}
