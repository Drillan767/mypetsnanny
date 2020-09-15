<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageHandler;
use Illuminate\Http\Client\Request;
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

    public function store(CategoryRequest $request)
    {
        dd($request);
    }


}
