<?php

use Illuminate\Support\Arr;

function c($dot, $default = null)
{
    return Arr::get(\App\Models\Setting::globals(), $dot) ?? $default;
}
