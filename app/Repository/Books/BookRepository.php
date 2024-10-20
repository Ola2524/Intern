<?php

namespace App\Repository\Books;

use App\Interfaces\Books\BookRepositoryInterface;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Http\Traits\ApiHandler;

class BookRepository implements BookRepositoryInterface
{
    use ApiHandler;

    public function index() {
        $books = Book::all();

        if (count($books) > 0) {
            return $this->successResponse($books, 'Books is retrieved successfully.', 200);
        }

        return $this->errorResponse(null, 'error, no books found', 404);
    }

    public function store(StoreBookRequest $request) {
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'autor_name' => $request->autor_name,
            'ISBN' => $request->ISBN,
            'publisher_name' => $request->publisher_name,
            'published_date' => $request->published_date,
            'total_pages' => $request->total_pages,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);

        if (!$book) {
            return $this->errorResponse(null, 'error, book not added.', 400);
        }
        return $this->successResponse($book, 'Books is stored successfully.', 201);
    }

    public function update(UpdateBookRequest $request, $id) {
        $book = Book::find($id);

        if (!$book) {
            return $this->errorResponse(null, 'error, book not found.', 404);
        }

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'autor_name' => $request->autor_name,
            'ISBN' => $request->ISBN,
            'publisher_name' => $request->publisher_name,
            'published_date' => $request->published_date,
            'total_pages' => $request->total_pages,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);
        return $this->successResponse($book, 'Books is updated successfully.', 200);
    }

    public function delete($id) {
        $book = Book::find($id);

        if (!$book) {
            return $this->errorResponse(null, 'error, book not found.', 404);
        }

        $book->delete();
        return $this->successResponse($book, 'Books is deleted successfully.', 200);
    }
}
