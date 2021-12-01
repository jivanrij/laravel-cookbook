<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Validator;

class DomainRule implements Rule
{
    public function __construct(public bool $nullable)
    {
    }

    public function passes($attribute, $value)
    {
        if (empty($value) && $this->nullable) {
            return true;
        }

        $validator = Validator::make([$attribute => $value], [
            $attribute => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);

        return $validator->valid();
    }

    public function message()
    {
        return __('The domain you have provided does not have the correct format.');
    }
}
