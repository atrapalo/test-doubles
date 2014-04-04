<?php

namespace Test\Atrapalo\Trainings\TestDoubles\Sample3;

use Atrapalo\Trainings\TestDoubles\Sample4\BirthdayGreeter;
use Atrapalo\Trainings\TestDoubles\Sample4\Collection;
use Atrapalo\Trainings\TestDoubles\Sample4\EmailService;
use Atrapalo\Trainings\TestDoubles\Sample4\User;
use Mockery;
use PHPUnit_Framework_TestCase;

class BirthdayGreeterTest extends PHPUnit_Framework_TestCase
{
    public function testSendGreetingsTo()
    {
        $emailService = new EmailServiceSpy();
        $bithdayGreeter = new BirthdayGreeter($emailService);

        $aCollectionOfUsers = new Collection();
        $aCollectionOfUsers
            ->add(new User('test1@gmail.com'))
            ->add(new User('test2@gmail.com'))
            ->add(new User('test3@gmail.com'))
            ->add(new User('test4@gmail.com'))
        ;

        $bithdayGreeter->sendGreetingsTo($aCollectionOfUsers);

        $this->assertTrue($emailService->hasSentEmails());
        $this->assertSame(4, $emailService->getNumberOfEmailsSent());
    }

    public function testSendGreetingsToWithMockery()
    {
        $numberOfEmailsSent = 0;

        $emailService = Mockery::mock('Atrapalo\Trainings\TestDoubles\Sample4\EmailService');
        $emailService
            ->shouldReceive('sendBirthdayGreetingTo')
            ->with(
                Mockery::on(function($anEmail) use (&$numberOfEmailsSent) {
                    $numberOfEmailsSent++;

                    return true;
                })
            )
        ;

        $bithdayGreeter = new BirthdayGreeter($emailService);

        $aCollectionOfUsers = new Collection();
        $aCollectionOfUsers
            ->add(new User('test1@gmail.com'))
            ->add(new User('test2@gmail.com'))
            ->add(new User('test3@gmail.com'))
            ->add(new User('test4@gmail.com'))
        ;

        $bithdayGreeter->sendGreetingsTo($aCollectionOfUsers);

        $this->assertGreaterThan(0, $numberOfEmailsSent);
        $this->assertSame(4, $numberOfEmailsSent);
    }
}

class EmailServiceSpy extends EmailService
{
    private $numberOfEmailsSent = 0;

    public function sendBirthdayGreetingTo($aUserEmail)
    {
        $this->numberOfEmailsSent++;
    }

    public function hasSentEmails()
    {
        return $this->numberOfEmailsSent > 0;
    }

    /**
     * @return int
     */
    public function getNumberOfEmailsSent()
    {
        return $this->numberOfEmailsSent;
    }
}