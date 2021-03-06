<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScaleImage extends FormRequest
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
        return ['file_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'];
    }
    public function messages()
    {
        return ['file_upload.required'=>"Please upload file first"];
    }
}
