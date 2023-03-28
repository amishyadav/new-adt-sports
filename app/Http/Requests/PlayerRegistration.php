<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PlayerRegistration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
//        dd($request->all());
        return [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required|email|unique:users,email|regex:/(.*)@(.*)\.(.*)/',
            'contact'           => 'required|unique:users,contact',
            'password'          => 'required|same:password_confirmation|min:8',
            'position'          => 'required',
            'gender'            => 'required',
            'profile'           => 'nullable|mimes:jpeg,png,jpg|max:5000',
            'aadhar_card_image' => 'nullable|mimes:jpeg,png,jpg|max:5000',
        ];
    }
}
