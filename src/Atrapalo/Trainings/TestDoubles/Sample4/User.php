<?php

namespace Atrapalo\Trainings\TestDoubles\Sample4;

class User
{
    /**
     * @var string
     */
    private $email;

    /**
     * Class constructor
     *
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}