<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
        return [
            'image'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'     => 'required|min:3',
            'age'      => 'required|numeric',
            'address'  => 'required|min:10',
            'phone'    => 'required|numeric'
        ];
    }
}