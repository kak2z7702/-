<?php


namespace App\Http\Requests;


class PostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:6|max:255',
            'hint' => 'required|min:6|max:255',
            'body' => 'required|min:6|max:65000',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}