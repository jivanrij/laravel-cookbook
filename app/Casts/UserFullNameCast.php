<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

class UserFullNameCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): string
    {
        $middleName = '';
        if (Str::replace(' ', '', $model->middle_name) !== '') {
            $middleName = $model->middle_name . ' ';
        }

        return "{$model->first_name} {$middleName}{$model->last_name}";
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        $firstName = Str::before($value, ' ');
        $lastName = Str::afterLast($value, ' ');

        $middleName = Str::replace($firstName . ' ', '', $value);
        $middleName = Str::replace(' ' . $lastName, '', $middleName);

        return [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
        ];
    }
}
