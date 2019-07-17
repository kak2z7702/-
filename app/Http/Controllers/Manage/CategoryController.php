<?php

namespace App\Http\Controllers\Manage;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function create()
    {
        return view('manage.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category($request->input());
        $category->save();
        return redirect('manage');
    }

    public function edit(Category $category)
    {
        return view('manage.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->input());
        $category->save();

        return redirect('manage');

    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->input('id'));
        $category->delete();

        //тут надо что то сделать с потерянными постами из этой
        // категории или удалить или прикрепить к другой
        //категории что то типа "Без категории"

        return response()->json([], 200);;
    }

}
