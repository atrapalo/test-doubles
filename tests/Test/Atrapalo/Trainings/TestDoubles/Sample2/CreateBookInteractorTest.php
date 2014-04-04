<?php

namespace Test\Atrapalo\Trainings\TestDoubles\Sample2;

use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\Book;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\BookRepository;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor\CreateBookInteractor;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor\CreateBookRequest;
use PHPUnit_Framework_TestCase;

class CreateBookInteractorTest extends PHPUnit_Framework_TestCase
{
    private $bookRepository;

    public function testExecute()
    {
        $this->bookRepository =  new InMemoryBookRepository();

        $createBookInteractor = new CreateBookInteractor(
            $this->bookRepository
        );

        $createBookInteractor->execute(
            new CreateBookRequest('test', 'Libro')
        );

        $this->assertTrue(
            $this->bookRepository->exists('Libro')
        );
    }
}

class InMemoryBookRepository implements BookRepository
{
    private $books = [];

    public function save(Book $aBook)
    {
        $this->books[$aBook->getTitle()] = $aBook;
    }

    public function remove(Book $aBook)
    {
        unset($this->books[$aBook->getTitle()]);
    }

    public function find($aBookTitle)
    {
        return $this->books[$aBookTitle];
    }

    public function exists($aBookTitle)
    {
        return isset($this->books[$aBookTitle]);
    }
}
