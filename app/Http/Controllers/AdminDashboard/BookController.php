<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;

use App\Interfaces\Books\BookRepositoryInterface;

class BookController extends Controller
{
    private $books;

    public function __construct(BookRepositoryInterface $books)
    {
        $this->books = $books;
    }

    public function index() {
        return $this->books->index();
    }

    public function store(StoreBookRequest $request) {
        return $this->books->store($request);
    }

    public function update(UpdateBookRequest $request, $id) {
        return $this->books->update($request, $id);
    }

    public function delete($id) {
        return $this->books->delete($id);
    }
}
