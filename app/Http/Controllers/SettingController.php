<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function edit ()
    {
        return Inertia::render('Settings/Edit', ['settings' => Setting::first()]);
    }

    public function update ()
    {
        //
    }
}
