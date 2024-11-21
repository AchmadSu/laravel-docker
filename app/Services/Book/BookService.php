<?php

namespace App\Services\Book;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface BookService extends BaseService
{

    /**
     * getAllBooks
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function getAll(Request $request);

    /**
     * getBooksById
     *
     * @param  int $id
     * @return array
     */
    public function getById(int $id);

    /**
     * createBooks
     *
     * @param  mixed $data
     * @return void
     */
    public function create($data);
}
