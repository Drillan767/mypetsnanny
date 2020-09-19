<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\ImageHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * @return Response
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
     * @return Response
     */
    public function show (Category $category)
    {
        return Inertia::render('Category/Show', compact('category'));
    }

    /**
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $this->handleCategories($request, $category);

        return Redirect::route('category.all', ['categories' => Category::all()])->with('success', 'La catégorie a bien été créée.');
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request)
    {
        $category = Category::find($request->get('id'));
        $this->handleCategories($request, $category);

        return Redirect::route('category.all', ['categories' => Category::all()])->with('success', 'La catégorie a bien été mise à jour.');
    }


    public function delete (Category $category)
    {
        ImageHandler::cleanup('category', $category->id);
        $category->delete();
        return Redirect::route('category.all', ['categories' => Category::all()])->with('success', 'La catégorie a bien été supprimée.');
    }

    /**
     * @param StoreCategoryRequest|UpdateCategoryRequest $request
     * @param Category $category
     * @param bool $edit
     */
    private function handleCategories ($request, Category $category, $edit = FALSE) : void
    {
        foreach (['title', 'description', 'color', 'whole_day'] as $field) {
            $category->{$field} = $request->get($field);

            if ($field === 'whole_day') {
                $category->{$field} = $request->get($field) === 1;
            }
        }

        if ($edit && $request->has('icon')) {
            $category->icon = ImageHandler::upload($request->file('icon'), 'category', $category->id, TRUE);
        } else {
            $category->icon = '';
            $category->save();

            $category->icon = ImageHandler::upload($request->file('icon'), 'category', $category->id);
        }

        $category->save();
    }
}
