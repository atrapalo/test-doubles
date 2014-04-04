<?php

namespace Atrapalo\Trainings\TestDoubles\Sample4;

class Collection
{
    private $collection = [];

    public function each(callable $callable)
    {
        array_map(
            $callable,
            $this->collection
        );
    }
}