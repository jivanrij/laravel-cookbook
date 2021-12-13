<?php

namespace App\Models\Relations;

use App\Models\PersonalInfo;

trait HasOnePersonalInfo
{
    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class);
    }
}
