<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo'        => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'         => 'required|min:5',
            'email'        => 'required|min:10',
            'phone'        => 'required|numeric',
            'review'       => 'required|min:5'
        ];
    }
}
