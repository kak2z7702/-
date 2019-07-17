<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Yajra\DataTables\Facades\DataTables;

class IndexController extends Controller
{


    /**
     * index pages with post and category tables
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('manage.index');
    }

    /**
     * datatables posts
     * @return mixed
     * @throws \Exception
     */
    public function indexPostDataTables()
    {
        $posts = Post::query();

        return DataTables::of($posts)->make();

    }

    /**
     * datatables categories
     * @return mixed
     * @throws \Exception
     */
    public function indexCategoryDataTables()
    {
        $categories = Category::query();

        return DataTables::of($categories)->make();

    }

}
