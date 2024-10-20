<?php

namespace App\Repository\Borrowing;

use App\Interfaces\Borrowing\BorrowRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\BorrowingHistory;
use App\Models\Book;
use App\Models\User;
use App\Http\Traits\ApiHandler;
use Carbon\Carbon;
use App\Http\Requests\Borrowing\BorrowingRequest;
use App\Http\Requests\Borrowing\returningRequest;

class BorrowRepository implements BorrowRepositoryInterface
{
    use ApiHandler;

    public function borrow(BorrowingRequest $request) {
        $book = Book::find($request->book_id);

        if (!$book) {
            return $this->errorResponse(null, 'error, no books found', 404);
        }

        // prevent borrowing the same book twice
        $previous_borrowed = BorrowingHistory::where('book_id', $request->book_id)->where('user_id', Auth()->id())->first();

        if($previous_borrowed != null) {
            return $this->errorResponse(null, 'error, cannot borrow book twice.', 400);
        }

        $book->quantity = $book->quantity - 1;
        $book->popular_rank = $book->popular_rank + 1;
        $book->save();

        $borrowedBooks = BorrowingHistory::create([
            'user_id' => Auth()->id(),
            'book_id' => $request->book_id,
            'borrowing_date' => Carbon::now(),
            'returning_date' => $request->returning_date
        ]);

        return $this->successResponse($borrowedBooks, 'Books is borrowed successfully.', 201);
    }

    public function return(returningRequest $request) {
        $user = User::find(Auth()->id());
        if (!$user) {
            return $this->errorResponse(null, 'error, user not found', 404);
        }

        $borrowedBook = BorrowingHistory::where('book_id', $request->book_id)->where('user_id', Auth()->id())->first();

        if (!$borrowedBook) {
            return $this->errorResponse(null, 'error, no book found', 404);
        }

        // delete book from user borrowing history
        $borrowedBook->delete();

        // add book to the shelve of the library
        $book = Book::findOrFail($request->book_id);
        $book->quantity+=1;
        $book->save();

        return $this->successResponse($borrowedBook, 'Borrowed Books is retrieved successfully.', 200);
    }

    public function borrowHistory() {
        $user = User::find(Auth()->id());
        if (!$user) {
            return $this->errorResponse(null, 'error, user not found', 404);
        }

        $books = $user->books;
        return $this->successResponse($books, 'Borrowed Books is retrieved successfully.', 200);
    }

}
