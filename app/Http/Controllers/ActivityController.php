<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ActivityController extends Controller
{
    /**
     * @return Response
     */
    public function all ()
    {
        $activities = Activity::with('category')->get();
        return Inertia::render('Activity/All', compact('activities'));
    }

    /**
     * @return Response
     */
    public function create ()
    {
        $categories = Category::all();
        return Inertia::render('Activity/Create', compact('categories'));
    }

    /**
     * @param ActivityRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store (ActivityRequest $request)
    {
        $this->handleActivities(new Activity(), $request);
        $activities = Activity::with('category')->get();
        return Redirect::route('activity.all', compact('activities'))->with('success', 'La prestation a été créée.');

    }

    public function edit (Activity $activity)
    {
        return Inertia::render('Activity/Edit', compact('activity'));
    }

    public function update ()
    {

    }

    public function delete (Activity $activity)
    {
        $activity->delete();
        $activities = Activity::with('category')->get();
        return Redirect::route('activity.all', compact('activities'))->with('success', 'La prestation a été supprimée.');
    }

    /**
     * @param Activity $activity
     * @param Request $request
     * @param boolean $editing
     * @throws Exception
     */
    private function handleActivities (Activity $activity, Request $request, $editing = FALSE)
    {
        $fields = [
            'title',
            'beginning',
            'ending',
            'latitude',
            'longitude',
            'walk_category',
            'accepted',
            'category_id',
            'price_dog',
            'price_cat',
            'public',
            'initial_slots',
            'remaining_slots',
            'reference',
        ];

        foreach ($fields as $field) {
            switch ($field) {
                case 'accepted':
                    $activity->{$field} = json_encode($request->get($field));
                    break;

                case 'beginning':
                case 'ending':
                    $activity->beginning = (new \DateTime($request->get('beginning')))->format('Y-m-d H:i:s');

                    if ($request->filled($field)) {
                        $activity->ending = (new \DateTime($request->get('beginning')))->format('Y-m-d H:i:s');
                    } else {
                        $activity->ending = $activity->beginning;
                    }
                    break;

                case 'remaining_slots':
                    if (!$editing) {
                        $activity->remaining_slots = $activity->initial_slots;
                    }
                    break;

                case 'reference':
                    $category = Category::find($request->get('category_id'));
                    if ($category->slug === 'balade') {
                        $reference = $request->get('walk_category');
                    } else {
                        $reference = $category->slug;
                    }

                    $activity->{$field} = $reference . '_' . (new \DateTime($request->get('beginning')))->format('dmY');
                    break;

                default:
                    $activity->{$field} = $request->get($field);
            }
        }

        $activity->save();
    }
}
