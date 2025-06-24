<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'title' => ['nullable','string','max:255'],
            'type' => ['required','string','max:2000'],
            'url' => ['required','string','max:1000'],
            'des' => ['nullable','string','max:2500'],
            'serial' => ['required','numeric','max:20000'],
        ];
    }
}
