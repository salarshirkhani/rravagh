<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Category;

class CategoryStoreRequest extends CategoryRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    public function rules()
    {
        return parent::rules();
    }
}
