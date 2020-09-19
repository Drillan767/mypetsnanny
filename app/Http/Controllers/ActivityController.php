<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ActivityController extends Controller
{
    /**
     * @return Response
     */
    public function all ()
    {
        $categories = Activity::all();
        return Inertia::render('Activity/All', [
            'categories' => $categories,
        ]);
    }

    /**
     * @return Response
     */
    public function create ()
    {
        $categories = Category::all();
        return Inertia::render('Activity/Create', compact('categories'));
    }

    public function store ()
    {

    }

    public function edit ()
    {
        return Inertia::render('Activity/Edit');
    }

    public function update ()
    {

    }

    public function delete ()
    {

    }
}
