<?php

class RemoveBookRequest
{
    /**
     * @var string
     */
    private $title;

    /**
     * Class constructor
     *
     * @param string $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
