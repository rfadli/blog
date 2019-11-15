<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;
use App\User;

class BlogController extends Controller
{   
    protected $limit = 3;
    
    public function index()
    {

        /*---------------Configurasi On ComposerServiceProvider.php-------------*/
        // $categories = Category::with(['posts' => function($query) {
        //     $query->published();
        // }])->orderBy('title', 'asc')->get();
        /*----------------------------------------------------------------------*/

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

        /*---------------Configurasi On ComposerServiceProvider.php-------------*/
        // $categories = Category::with(['posts' => function($query) {
        //     $query->published();
        // }])->orderBy('title', 'asc')->get();
        /*--------------------------------------------------------------------- */

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

        return view("blog.index", compact('posts', 'categoryName'));
        //dd(\DB::getQuerylog());
    }

    public function author(User $author)
    {
        //dd($author->name);

        $authorName = $author->name;

        /*---------------Configurasi On ComposerServiceProvider.php-------------*/
        // $categories = Category::with(['posts' => function($query) {
        //     $query->published();
        // }])->orderBy('title', 'asc')->get();
        /*--------------------------------------------------------------------- */

        // \DB::enableQueryLog();
        //$posts = Post::with('author')->orderBy('created_at', 'desc')->get();

        // $posts = Post::with('author')
        //             ->latestFirst()
        //             ->published()
        //             ->where('category_id', $id)
        //             ->simplePaginate($this->limit);

        $posts = $author->posts()
                        ->with('category')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'authorName'));
        //dd(\DB::getQuerylog());
    }

    public function show(Post $post)
    {
        /*---------------Configurasi On ComposerServiceProvider.php-------------*/
        // $categories = Category::with(['posts' => function($query) {
        //     $query->published();
        // }])->orderBy('title', 'asc')->get();
        /*----------------------------------------------------------------- */
        //update post set view_count = view_count + 1 where id = ?
        # 1
        // $viewCount = $post->view_count + 1;
        // $post->update(['view_count' => $viewCount]);
        # 2
        $post->increment('view_count');

        return view("blog.show", compact('post'));
    }
}
