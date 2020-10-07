<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Landing;
use Inertia\Inertia;
use Spatie\Honeypot;

class HomeController extends Controller
{
    public function landing ()
    {

        return Inertia::render('Home/Landing'/*, ['landing' => Landing::first()]*/);
    }

    public function submit (ContactRequest $request)
    {
        // Sends an email to Aleks
    }

    /**
     * Displays the landing page's edition form.
     *
     * @return \Inertia\Response
     */
    public function edit ()
    {
        return Inertia::render('Home/Edit/LandingEdit', ['landing' => Landing::first()]);
    }

    public function update ()
    {

    }
}
