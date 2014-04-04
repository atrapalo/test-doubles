<?php

namespace Atrapalo\Trainings\TestDoubles\Sample2\Amazon\Domain\Model;

interface BookRepository
{
    public function save(Book $aBook);
    public function remove(Book $aBook);
    public function find($aBookTitle);
    public function exists($aBookTitle);
}