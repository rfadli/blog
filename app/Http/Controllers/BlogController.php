<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{   
    protected $limit = 3;
    
    public function index()
    {
        //\DB::enableQueryLog();
        //$posts = Post::with('author')->orderBy('created_at', 'desc')->get();
        $posts = Post::with('author')->latestFirst()->simplePaginate($this->limit);
        return view("blog.index", compact('posts'));
        //dd(\DB::getQuerylog());
    }
}
