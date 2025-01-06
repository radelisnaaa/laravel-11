<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //validate
        return [
            'image'   => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'    => 'required|min:3',
            'age'     => 'required|min:3',
            'address' => 'required|min:20',
            'phone'   => 'required|min:3'
        ];
    }
}
