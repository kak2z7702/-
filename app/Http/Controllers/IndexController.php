<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::sortable()->paginate(15);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCategory(Category $category)
    {
        $posts = $category->posts()->sortable()->paginate(15);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function viewPost(Post $post)
    {
        return view('post', [
            'post' => $post,
        ]);

    }
}
