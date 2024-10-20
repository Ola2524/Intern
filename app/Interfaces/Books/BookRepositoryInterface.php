<?php

namespace App\Interfaces\Books;


use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;

/**
* Interface BooksRepositoryInterface
* @package App\Repositories
*/
interface BookRepositoryInterface
{
    public function index();
    public function store(StoreBookRequest $request);
    public function update(UpdateBookRequest $request, $id);
    public function delete($id);
}
