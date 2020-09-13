<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function show (Category $category)
    {
        return Inertia::render('Category/Show', compact('category'));
    }
}
