<?php

namespace App\Interfaces\Borrowing;


use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Borrowing\BorrowingRequest;
use App\Http\Requests\Borrowing\returningRequest;

/**
* Interface BorrowRepositoryInterface
* @package App\Repositories
*/
interface BorrowRepositoryInterface
{
    public function borrow(BorrowingRequest $request);
    public function return(returningRequest $request);
    public function borrowHistory();
}
