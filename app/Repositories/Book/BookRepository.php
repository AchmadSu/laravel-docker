<?php

namespace App\Repositories\Book;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface BookRepository extends Repository
{

    /**
     * getAll
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function getAll(Request $request);

    /**
     * getById
     *
     * @param  int $id
     * @return array
     */
    public function getById(int $id);

    /**
     * addBook
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function create($data);
}
