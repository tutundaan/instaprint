<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class RatingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee' => 'required|exists:employees,id',
            'discipline' => 'required|numeric|min:1|max:5',
            'teamwork' => 'required|numeric|min:1|max:5',
            'skill' => 'required|numeric|min:1|max:5',
            'accuracy' => 'required|numeric|min:1|max:5',
            'speed' => 'required|numeric|min:1|max:5',
        ];
    }
}
