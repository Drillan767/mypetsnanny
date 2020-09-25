<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ActivityController extends Controller
{

    protected $activities;

    public function __construct()
    {
        $this->activities = Activity::with('category')->get();
    }

    /**
     * @return Response
     */
    public function all ()
    {
        return Inertia::render('Activity/All', ['activities' => $this->activities]);
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function dashboard ()
    {
        $activities = Activity::with(['category' => function($query) {
            $query->select('id', 'color', 'whole_day');
        }])->get(['title', 'category_id', 'beginning', 'ending']);
        $dates = [];

        foreach($activities as $activity) {
            $category = $activity->category()->first();
            $date = [
                'title' => $activity->title,
                'color' => $category->color,
            ];

            if ($category->whole_day) {
                $date['start'] = (new \DateTime($activity->beginning))->format('YYYY-MM-DD');
                $date['allDay'] = TRUE;
            } else {
                $date['start'] = $activity->beginning;
                $date['end'] = $activity->ending;
            }

            $dates[] = $date;
        }

        return Inertia::render('Dashboard', compact('dates'));
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
        return Redirect::route('activity.all', ['activities' => $this->activities])->with('success', 'La prestation a été créée.');

    }

    public function edit (Activity $activity)
    {
        $categories = Category::all();
        return Inertia::render('Activity/Edit', compact('activity', 'categories'));
    }

    /**
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return RedirectResponse
     * @throws Exception
     */
    public function update (ActivityRequest $request, Activity $activity)
    {
        $this->handleActivities($activity, $request);
        return Redirect::route('activity.all', ['activities' => $this->activities])->with('success', 'La prestation a été mise à jour.');
    }

    public function delete (Activity $activity)
    {
        $activity->delete();
        return Redirect::route('activity.all', ['activities' => $this->activities])->with('success', 'La prestation a été supprimée.');
    }

    /**
     * @param Activity $activity
     * @param Request $request
     * @param boolean $editing
     * @throws Exception
     */
    private function handleActivities (Activity $activity, Request $request, $editing = FALSE)
    {
        $category = Category::find($request->get('category_id'));
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
                    $activity->beginning = (new \DateTime($request->get('beginning')))->format('Y-m-d H:i:s');
                    break;
                case 'ending':
                    if ($category->whole_day) {
                        $activity->ending = $activity->beginning;
                    } else {
                        $activity->ending = (new \DateTime($request->get('ending')))->format('Y-m-d H:i:s');
                    }
                    break;

                case 'remaining_slots':
                    if (!$editing) {
                        $activity->remaining_slots = $activity->initial_slots;
                    }
                    break;

                case 'reference':
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
