<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tag' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ];
    }
}
