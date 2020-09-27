<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function __invoke ()
    {
        return Inertia::render('Client/Dashboard');
    }
}
