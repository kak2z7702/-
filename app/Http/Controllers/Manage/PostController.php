<?php

namespace App\Http\Controllers\Manage;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    /**
     * create new post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('manage.post.create', [
            'categories' => Category::orderBy('name', 'ASC')->get()
        ]);
    }

    /**
     * store new post
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {

        $post = new Post($request->input() + [
                'user_id' => $request->user()->id,
                'published' => 0
            ]);
        $post->save();
        return redirect('manage');
    }

    /**
     * edit post
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('manage.post.edit', [
            'categories' => Category::orderBy('name', 'ASC')->get(),
            'post' => $post,
        ]);
    }

    /**
     * update post
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->input());
        $post->save();

        return redirect('manage');

    }

    /**
     * delete post
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $post = Post::findOrFail($request->input('id'));
        $post->delete();
        return response()->json([], 200);;
    }

}
