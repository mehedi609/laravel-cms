<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:191|unique:posts,title,'.$this->post->id,
            'description' => 'required',
            'category' => 'required',
            'published_at' => 'nullable',
            'image' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Post Title should be unique'
        ];
    }
}
