<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\product;

class ProductStoreRequest extends ProductRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'pic' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
    }
}
