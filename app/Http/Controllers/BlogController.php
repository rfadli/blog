<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;

class BlogController extends Controller
{   
    protected $limit = 3;
    
    public function index()
    {

        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();
        //\DB::enableQueryLog();
        //$posts = Post::with('author')->orderBy('created_at', 'desc')->get();
        $posts = Post::with('author')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'categories'));
        //dd(\DB::getQuerylog());
    }

    public function category(Category $category)
    {

        $categoryName = $category->title;

        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();
        // \DB::enableQueryLog();
        //$posts = Post::with('author')->orderBy('created_at', 'desc')->get();

        // $posts = Post::with('author')
        //             ->latestFirst()
        //             ->published()
        //             ->where('category_id', $id)
        //             ->simplePaginate($this->limit);

        $posts = $category->posts()
                        ->with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'categories', 'categoryName'));
        //dd(\DB::getQuerylog());
    }

    public function show(Post $post)
    {
        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();

        return view("blog.show", compact('post', 'categories'));
    }
}
