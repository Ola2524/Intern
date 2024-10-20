<?php

namespace App\Repository\Reports;

use App\Interfaces\Reports\ReportRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\BorrowingHistory;
use App\Http\Traits\ApiHandler;
use App\Models\Book;
use App\Models\User;

class ReportRepository implements ReportRepositoryInterface
{
    use ApiHandler;

    public function borrowedReport() {
        $borrowedBooks = User::has('books')->with('books')->get();

        if (count($borrowedBooks) > 0) {
            return $this->successResponse($borrowedBooks, 'Books is retrieved successfully.', 200);
        }

        return $this->errorResponse(null, 'error, no borrowed books found', 404);
    }

    public function popularReport() {
        $popularBooks = Book::where('popular_rank','>', 0)->get();

        if (count($popularBooks) > 0) {
            return $this->successResponse($popularBooks, 'Books is retrieved successfully.', 200);
        }

        return $this->errorResponse(null, 'error, no borrowed books found', 404);
    }
}
