<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\LandingRequest;
use App\Http\Requests\NewsletterRequest;
use App\Models\Landing;
use App\Models\User;
use App\Notifications\Contact;
use App\Services\LandingImagesHandler;
use App\Services\Recaptcha;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class HomeController extends Controller
{
    public function landing ()
    {

        return Inertia::render('Home/Landing',
            [
                'landing' => Landing::first(),
                'recaptcha_key' => env('RECAPTCHA_PUBLIC'),
            ]);
    }

    public function submit (ContactRequest $request)
    {
        if (Recaptcha::validate($request->get('g_recaptcha_response')) !== TRUE) {
            return redirect()->back()->with('error', "Le recaptcha n'est pas valide");
        }

        $contact = [];
        $fields = ['email', 'first_name', 'last_name', 'subject', 'message'];
        foreach ($fields as $field) {
            $contact[$field] = $request->get($field);
        }

        dispatch(function () use ($contact) {
            Notification::route('mail', User::first()->email)->notify(new Contact($contact));
        })->afterResponse();

        return \redirect()->back()->with('success', "Merci pour votre message, nous vous recontacterons très vite !");
    }

    /**
     * @param NewsletterRequest $request
     *   The hash returned by the recaptcha
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe (NewsletterRequest $request)
    {
        if (Recaptcha::validate($request->get('g_recaptcha_response')) !== TRUE) {
            return redirect()->back()->with('error', "Le recaptcha n'est pas valide");
        }

        Newsletter::subscribe($request->get('email'));
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
        $landing = Landing::first();

        $fields = [
            'hero_overtitle',
            'hero_title',
            'hero_subtitle',
            'hero_video',
            'newsletter_title',
            'newsletter_text',
            'service1_title',
            'service1_text',
            'service2_title',
            'service2_text',
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
            $landing->$field = $request->get($field);
        }

        $medias = [
            'hero_banner' => '1920_1080',
            'newsletter_image' => '600_300',
            'whoami_image' => '350_600',
            'service1_image' => '640_360',
            'service2_image' => '640_360',
            'contact_image' => '1920_1080',
        ];

        foreach ($medias as $file => $format) {
            $image = $request->file($file);
            if ($image) {
                $base_path = 'landing/' . explode('_', $file)[0];
                $landing->$file = LandingImagesHandler::upload($image, $base_path, $format, $file === 'whoami_image');
            }
        }

        if ($request->file('gallery')) {
            $gallery = json_decode($landing->gallery);
            $images = $request->file('gallery');
            foreach ($images as $image) {
                $gallery[] = LandingImagesHandler::addToGallery($image, 'landing/gallery');
            }

            $landing->gallery = json_encode($gallery);
        }

        $gallery_delete = json_decode($request->get('galleryDelete'));
        if (!empty($gallery_delete)) {
            $gallery = json_decode($landing->gallery);
            $gallery = LandingImagesHandler::removeFromGallery($gallery, $gallery_delete);
            $landing->gallery = json_encode($gallery);
        }

        $landing->save();
        return Redirect::back()->with('success', "La page d'accueil a été mise à jour.");
    }
}
