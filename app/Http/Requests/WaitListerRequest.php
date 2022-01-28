<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WaitListerRequest extends FormRequest
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
            'email' => ['bail', 'required', 'email', 'unique:wait_listers,email'],
            'fullname' => ['bail', 'required', 'string'],
            'type' => ['bail', 'required', Rule::in('investor', 'asset_lister')],
            'asset_description' => ['bail', 'required_if:type,asset_lister', 'string'],
        ];
    }
}