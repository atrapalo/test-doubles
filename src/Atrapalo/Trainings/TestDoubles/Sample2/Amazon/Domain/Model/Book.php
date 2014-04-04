<?php

namespace Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model;

class Book
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * Class constructor
     *
     * @param string $author
     * @param string $title
     */
    public function __construct($author, $title)
    {
        $this->author = $author;
        $this->title = $title;
    }
}