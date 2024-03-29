<?php


namespace App\Http\Requests;


class CategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|max:255',
            'hint' => 'required|min:6|max:255',
        ];
    }
}