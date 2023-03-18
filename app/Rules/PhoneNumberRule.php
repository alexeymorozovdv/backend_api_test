<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $charsAfterCode = substr($value, 2);

        return (str_starts_with($value, '+7') || strlen($charsAfterCode) !== 10 || !is_numeric($charsAfterCode));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The phone number should start with +7 and after that should have 10 digits.';
    }
}
