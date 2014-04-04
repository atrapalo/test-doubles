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
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

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