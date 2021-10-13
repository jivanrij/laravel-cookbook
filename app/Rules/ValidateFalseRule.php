<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateFalseRule implements Rule
{
    public function passes($attribute, $value)
    {
        return false;
    }

    public function message()
    {
        return 'You will never be able to do this.';
    }
}
