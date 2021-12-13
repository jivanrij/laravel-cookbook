<?php

namespace App\Models\Relations;

trait MorphToImageable
{
    public function imageable()
    {
        return $this->morphTo();
    }
}
