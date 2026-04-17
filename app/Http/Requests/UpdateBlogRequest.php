<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $blogId = $this->route('blog')?->id;

        return [
            'tag' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,'.$blogId,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ];
    }
}
