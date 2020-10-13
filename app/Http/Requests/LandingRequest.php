<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === 'administrator';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hero_overtitle' => ['required','string'],
            'hero_title' => ['required','string'],
            'hero_subtitle' => ['required','string'],
            'hero_video' => ['nullable', 'file', 'mime:mp4,avi,mov'],
            'hero_banner' => ['nullable', 'image', 'mime:jpg,jpeg,png'],

            'newsletter_title' => ['required','string'],
            'newsletter_text' => ['required','string'],
            'newsletter_image' => ['nullable', 'image', 'mime:jpg,jpeg,png'],

            'services_data' => ['required', 'json'],

            'whoami_title' => ['required','string'],
            'whoami_text' => ['required','string'],
            'whoami_image' => ['nullable', 'image', 'mime:jpg,jpeg,png'],

            'getstarted1_title' => ['required', 'string'],
            'getstarted1_text' => ['required', 'string'],
            'getstarted2_title' => ['required', 'string'],
            'getstarted2_text' => ['required', 'string'],
            'getstarted3_title' => ['required', 'string'],
            'getstarted3_text' => ['required', 'string'],

            'contact_subtitle' => ['required', 'string'],
            'contact_image' => ['nullable', 'image', 'mime:jpg,jpeg,png'],
        ];
    }
}
