<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone_number' => ['required', 'unique:users,phone_number', new PhoneNumberRule()],
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(6)->letters()->mixedCase()->symbols()],
        ];
    }
}
