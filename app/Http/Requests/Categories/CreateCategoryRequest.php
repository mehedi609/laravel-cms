<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name|min:2|max:191'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Category name should be unique'
        ];
    }
}
