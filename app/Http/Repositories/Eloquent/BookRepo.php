<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\BookRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Book;



class BookRepo extends AbstractRepo implements BookRepoInterface
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }



}
