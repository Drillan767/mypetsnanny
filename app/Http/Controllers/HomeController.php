<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\LandingRequest;
use App\Http\Requests\NewsletterRequest;
use App\Services\ImageHandler;
use Illuminate\Http\Request;
use App\Models\Landing;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Spatie\Honeypot;
use Spatie\Newsletter\Newsletter;

class HomeController extends Controller
{
    public function landing ()
    {

        return Inertia::render('Home/Landing', ['landing' => Landing::first()]);
    }

    public function submit (ContactRequest $request)
    {
        // Sends an email to Aleks
    }

    public function subscribe (NewsletterRequest $request)
    {
        (new Newsletter)->subscribe($request->get('email'));
        return Redirect::back()->with('success', 'Merci !');
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

    public function update (LandingRequest $request)
    {
        dd($request);

        $landing = Landing::first();

        $fields = [
            'hero_overtitle',
            'hero_title',
            'hero_subtitle',
            'hero_video',
            'newsletter_title',
            'newsletter_text',
            'services_data',
            'whoami_title',
            'whoami_text',
            'getstarted1_title',
            'getstarted1_text',
            'getstarted2_title',
            'getstarted2_text',
            'getstarted3_title',
            'getstarted3_text',
            'contact_subtitle',
        ];

        foreach($fields as $field) {
            // TODO: Know if we have only 3 services or if it's dynamic.
            $landing->$field = $request->get($field);
        }

        $medias = [
            'hero_banner' => '1920_1080',
            'newsletter_image' => '600_300',
            'whoami_image' => '350_600',
//            'services' => '640_360',
            'contact_image' => '1920_1080',
        ];

        foreach ($medias as $file => $format) {
            if ($request->file($file)) {
                $base_path = 'landing/' . explode('_', $file)[0];
                Storage::disk('public')->deleteDirectory($base_path);
                $path = $request
                    ->file($file)
                    ->storePubliclyAs($base_path, $request
                        ->file($file)
                        ->getClientOriginalName(),
                        ['disk' => 'public']
                    );
                $landing->$file = "/storage/$path";



                if ($file !== 'hero_video') {
//                    $landing->$field = ImageHandler::resize($request->$field, $format);
                }

            }
        }

        $landing->save();
        return Redirect::back()->with('success', "La page d'accueil a été mise à jour.");
    }
}
