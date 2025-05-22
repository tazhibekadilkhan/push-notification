<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'   => ['required', 'string'],
            'message' => ['required', 'string'],
            'send_at' => ['date'],
        ];
    }
}
