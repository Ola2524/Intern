<?php

namespace App\Http\Controllers\UserDashoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Borrowing\BorrowRepositoryInterface;
use App\Http\Requests\Borrowing\BorrowingRequest;
use App\Http\Requests\Borrowing\returningRequest;

class BorrowingController extends Controller
{
    private $borrowedBooks;

    public function __construct(BorrowRepositoryInterface $borrowedBooks)
    {
        $this->borrowedBooks = $borrowedBooks;
    }

    public function borrow(BorrowingRequest $request) {
        return $this->borrowedBooks->borrow($request);
    }

    public function return(returningRequest $request) {
        return $this->borrowedBooks->return($request);

    }

    public function borrowHistory() {
        return $this->borrowedBooks->borrowHistory();
    }
}
