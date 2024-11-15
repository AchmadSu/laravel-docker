<?php

namespace App\Services\Book;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface BookService extends BaseService
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
}
