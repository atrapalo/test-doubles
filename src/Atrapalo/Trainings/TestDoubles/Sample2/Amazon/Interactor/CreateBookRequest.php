<?php

namespace Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor;

class CreateBookRequest
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
}