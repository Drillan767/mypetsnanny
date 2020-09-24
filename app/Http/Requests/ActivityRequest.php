<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
        $category = [];
        $categories = Category::all();
        foreach ($categories as $result) {
            $category[$result->slug] = $result;
        }

        return [
            'title' => ['required', 'string'],
            'category_id' => ['required', 'integer'],
            'beginning' => ['required', 'date', 'after:tomorrow'],
            'ending' => [
                'nullable',
                'required_if:category_id,' . $category['balade']->id . ',' . $category['visite']->id ,
                'after_or_equal:beginning',
                'date'
            ],
            'accepted' => ['required'],
            'walk_category' => ['nullable', 'required_if:category_id,' . $category['balade']->id, 'string'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'initial_slots' => ['required', 'min:1', 'max:10'],
            'price_cat' => ['nullable', 'string'],
            'price_dog' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'latitude.required' => 'Veuillez choisir une destionation',
            'category_id.required' => 'Le champ catégorie est requis',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
//        dd($validator->errors());
    }
}
