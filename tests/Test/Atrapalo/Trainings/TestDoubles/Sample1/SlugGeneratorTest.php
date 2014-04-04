<?php

namespace Test\Atrapalo\Trainings\TestDoubles\Sample1;

use Atrapalo\Trainings\TestDoubles\Sample1\SlugGenerator;
use PHPUnit_Framework_TestCase;

class SlugGeneratorTest extends PHPUnit_Framework_TestCase
{
    private $slugGenerator;

    public function testSlugify()
    {
        $title = 'Esto es un Titulo';

        $this->slugGenerator = new SlugGenerator();

        $this->assertEquals('esto-es-un-titulo',
            $this->slugGenerator->slugify($title, null));
    }
}