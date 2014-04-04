<?php

namespace Atrapalo\Trainings\TestDoubles\Sample1;

class SlugGenerator
{
    public function slugify($aTitle, $withSeparator = null)
    {
        if (null === $withSeparator) {
            $withSeparator = '-';
        }

        return str_replace(' ', $withSeparator, strtolower($aTitle));
    }
}
