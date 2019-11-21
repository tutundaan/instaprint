<?php

namespace App\Http\Requests\Auth;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'last_password' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
