<?php

namespace App\Http\Requests\Bug;

use Illuminate\Foundation\Http\FormRequest;

class BugUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'summary' => 'string|max:255',
            'description' => 'string|max:255',
        ];
    }
}
