<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageHandler;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function all ()
    {
        $categories = Category::all();
        return Inertia::render('Category/All', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param Category $category
     * @return \Inertia\Response
     */
    public function show (Category $category)
    {
        return Inertia::render('Category/Show', compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        foreach (['title', 'description', 'color'] as $field) {
            $category->$field = $request->get($field);
        }

        $category->whole_day = $request->get('whole_day') === '1' ;
        $category->icon = '';

        $category->save();

        $category->icon = ImageHandler::upload($request->file('icon'), 'category', $category->id);
        $category->save();

        return Redirect::route('category.all', ['categories' => Category::all()]);
    }


}
