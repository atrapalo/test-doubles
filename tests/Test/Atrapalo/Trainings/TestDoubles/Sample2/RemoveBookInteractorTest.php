<?php

namespace Test\Atrapalo\Trainings\TestDoubles\Sample2;

use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor\RemoveBookInteractor;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\Book;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor\RemoveBookRequest;
use Mockery;
use PHPUnit_Framework_TestCase;

class RemoveBookInteractorTest extends PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $bookRepository = Mockery::mock(
            'Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\BookRepository'
        );

        $aListOfBooks = [
            'Libro' => new Book('test', 'Libro')
        ];

        /** @link https://github.com/padraic/mockery/blob/master/docs/06-EXPECTATION%20DECLARATIONS.md */
        $bookRepository
            ->shouldReceive('find')
            ->once()
            ->andReturnUsing(function($aTitle) use ($aListOfBooks) {
                if (isset($aListOfBooks[$aTitle])) {
                    return $aListOfBooks[$aTitle];
                }
            })
        ;

        /** @link https://github.com/padraic/mockery/blob/master/docs/07-ARGUMENT-VALIDATION.md */
        $bookRepository
            ->shouldReceive('remove')
            ->once()
            ->with(
                Mockery::on(function(Book $aBook) use (&$aListOfBooks) {
                    if (isset($aListOfBooks[$aBook->getTitle()])) {
                        unset($aListOfBooks[$aBook->getTitle()]);

                        return true;
                    }

                    return false;
                })
            )
        ;

        $createBookInteractor = new RemoveBookInteractor($bookRepository);

        $createBookInteractor->execute(new RemoveBookRequest('Libro'));

        $this->assertEmpty($aListOfBooks);
    }
}