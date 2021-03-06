<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        
        //for terminal : 
        // php artisan make:request StorePostRequest
        // php artisan make:request UpdatePostRequest
      
        return [

            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'post_creator'=>'',
            'slug' => 'max:0',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'description is required',
            'slug' => 'Dont hack me',
        ];
    }
}
