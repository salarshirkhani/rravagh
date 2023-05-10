<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Http\Requests\HasCheckbox;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class ProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'explain' => ['required', 'string', 'max:2555'],
            'content' => ['required', 'string', 'max:100000'],
            'category' => ['required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('type', 'product');
                })],
            'specifications' => ['required', 'array'],
            'specifications.*' => ['required', 'array'],
            'specifications.*.key' => ['required', 'string', 'max:255'],
            'specifications.*.value' => ['required', 'string', 'max:4096'],
        ];
    }

    public function validated()
    {

        return $data;
    }

}
