<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Title & description are required , minimum length for title is 3
        // chars and unique, for description the minimum length is 10
        // chars ,
        // Also make sure that no one hacks you and send an id of post
        // creator that doesn’t exist in the database
        return [

            'title' => ['required', 'min:3', 'unique:App\Models\Post,title'],
            'description' => ['required', 'min:10'],

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'description is required',
        ];
    }
}
