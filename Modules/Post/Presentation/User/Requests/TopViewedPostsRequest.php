<?php

namespace Post\Presentation\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopViewedPostsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => [
                'sometimes',
                'integer',
                'min:1',
                'max:100',
            ],
        ];
    }
}
