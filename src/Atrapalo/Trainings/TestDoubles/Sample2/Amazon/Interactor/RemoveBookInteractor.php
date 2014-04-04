<?php

namespace Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Interactor;

use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\Book;
use Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model\BookRepository;

class RemoveBookInteractor
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute(RemoveBookRequest $aRemoveBookRequest)
    {
        $aBook = $this->bookRepository->find($aRemoveBookRequest->getTitle());

        $this->bookRepository->remove($aBook);
    }
}