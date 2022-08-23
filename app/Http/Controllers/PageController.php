<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Comment;
use App\Models\Comments;
use Symfony\Component\Console\Input\Input;
use Whoops\Run;

class PageController extends Controller
{
    public function index()
    {
        $categories = Categories::where('active', 1)->orderBy('created_at', 'DESC')->get();
        $randNews = News::orderby('created_at', 'DESC')->get()->where('active', 1)->groupBy('category_id');
        $newsNews = News::orderBy('created_at', 'DESC')->where('active', 1)->paginate(8);

        return view('pages.home')->with(compact('categories', 'randNews', 'newsNews'));
    }

    public function show($id)
    {
        $categories = Categories::orderBy('id')->where('active', 1)->get();
        $news = News::find($id);
        $users = User::all();
        $comments = Comments::orderBy('created_at', 'DESC')->where('news_id', $id)->get();

        return view('pages.detail')->with(compact('categories', 'news', 'users', 'comments'));
    }

    public function commentstore(Request $request){
        $content = $request->input('comment');
        $author_id = $request->input('author_id');
        $news_id = $request->input('news_id');

        $comment = new Comments();
        $comment->content = $content;
        $comment->author_id = $author_id;
        $comment->news_id = $news_id;

        $comment->save();

        return redirect()->route('page.show', [$news_id]);

    }

    public function search(Request $request)
    {
        $categories = Categories::orderBy('id')->where('active', 1)->get();
        $keyword = $request->input('keyword');
        $allNews = News::where('title','like',"%$keyword%")->orWhere('sumary','like',"%$keyword%")->where('active', 1)->orderBy('created_at', 'DESC')->paginate(10);

        return view('pages.listnews')->with(compact('categories', 'keyword', 'allNews'));
    }

    public function categorynews($id_category)
    {
        $categories = Categories::orderBy('id')->where('active', 1)->get();
        $allNews = News::where('category_id', $id_category)->where('active', 1)->orderBy('created_at', 'DESC')->paginate(10);
        $categorynews = Categories::find($id_category);
        return view('pages.categorynews')->with(compact('categories', 'allNews', 'categorynews'));
    }
}
