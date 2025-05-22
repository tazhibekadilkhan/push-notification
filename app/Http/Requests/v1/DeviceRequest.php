<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
            'token' => ['required', 'string', 'unique:devices,token']
        ];
    }
}
