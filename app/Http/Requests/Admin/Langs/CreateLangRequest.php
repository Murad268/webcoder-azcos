<?php

namespace App\Http\Requests\Admin\Langs;

use Illuminate\Foundation\Http\FormRequest;

class CreateLangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'site_code' => 'required',
        ];
    }
}
