<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'max:255'],
            'current_password' => ['required'],
            'new_password' => ['required', 'string',Password::defaults()],
            'password_confirmation' => ['required', 'string',Password::defaults()],
            'name' => ['required', 'string', 'max:255'],
            'token' => ['required', 'max:255']
        ];
    }
}
