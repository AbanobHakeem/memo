<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class LanguageRequest extends FormRequest
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
        return [
            "prefix" => ['required', ValidationRule::unique('languages')->ignore($this->language)],
            "name" => 'required',
            "script" => 'required',
            "native" => 'required',
            "regional" => 'required',
            "dir" => "in:rtl,ltr"
        ];
    }
}
