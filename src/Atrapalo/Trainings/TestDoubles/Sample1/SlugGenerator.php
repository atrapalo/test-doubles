<?php

namespace Atrapalo\Trainings\TestDoubles\Sample1\SlugGenerator;

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