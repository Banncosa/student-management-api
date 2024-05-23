<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            'subject_code' => 'required|string|max:10',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'instructor' => 'required|string|max:100',
            'schedule' => 'required|string|max:50',
            'grades' => 'required|array',
            'grades.*' => 'numeric',
            'date_taken' => 'required|date_format:Y-m-d',
        ];
    }
}
