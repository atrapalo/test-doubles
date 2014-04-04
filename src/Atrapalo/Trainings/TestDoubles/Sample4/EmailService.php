<?php

namespace Atrapalo\Trainings\TestDoubles\Sample4;

use Exception;

class EmailService
{
    public function sendBirthdayGreetingTo($aUserEmail)
    {
        throw new Exception('Cannot send emails!!!!!');
    }
}