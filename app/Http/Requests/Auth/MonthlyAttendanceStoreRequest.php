<?php

namespace App\Http\Requests\Auth;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class MonthlyAttendanceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'attendance' => 'required|file'
        ];
    }
}
