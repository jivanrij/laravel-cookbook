<?php

namespace App\Models\Relations;

use App\Models\User;

trait HasOneUser
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
