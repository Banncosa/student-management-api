<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthdate' => 'required|date_format:Y-m-d',
            'sex' => 'required|string|in:MALE,FEMALE',
            'address' => 'required|string|max:100',
            'year' => 'required|integer',
            'course' => 'required|string|max:50',
            'section' => 'required|string|max:10',
        ];
    }
}
