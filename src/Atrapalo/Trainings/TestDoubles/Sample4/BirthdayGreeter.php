<?php

namespace Atrapalo\Trainings\TestDoubles\Sample4;

class BirthdayGreeter
{
    /**
     * @var EmailService
     */
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function sendGreetingsTo(Collection $users)
    {
        $callable = function (User $aUser) {
            $this->emailService->sendBirthdayGreetingTo($aUser->getEmail());
        };

        $users->each($callable->bindTo($this));
    }
}