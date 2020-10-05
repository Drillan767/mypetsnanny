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
        return Inertia::render('Home/Landing', );
    }

    public function submit (ContactRequest $request)
    {
        // Sends an email to Aleks
    }

    public function edit ()
    {
        //
    }
}
