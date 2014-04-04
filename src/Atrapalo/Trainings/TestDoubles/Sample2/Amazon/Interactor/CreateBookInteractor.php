<?php

namespace Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor;

use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\Book;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\BookRepository;

class CreateBookInteractor
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute(CreateBookRequest $aCreateBookRequest)
    {
        $aBookTitle     = $aCreateBookRequest->getTitle();
        $aBookAuthor    = $aCreateBookRequest->getAuthor();

        $this->bookRepository->save(
            new Book($aBookAuthor, $aBookTitle)
        );
    }
}