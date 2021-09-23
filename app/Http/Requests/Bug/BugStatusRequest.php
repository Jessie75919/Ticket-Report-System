<?php

namespace App\Http\Requests\Bug;

use App\Models\Bug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BugStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => Rule::in([Bug::STATUS_PENDING, Bug::STATUS_PROCESSING, Bug::STATUS_RESOLVED])
        ];
    }
}
