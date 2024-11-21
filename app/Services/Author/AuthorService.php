<?php

namespace App\Services\Author;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface AuthorService extends BaseService
{

    /**
     * getAllAuthors
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function getAll(Request $request);

    /**
     * getByAuthorId
     *
     * @param  int $id
     * @return array
     */
    public function getById(int $id);

    /**
     * getByAuthorEmail
     *
     * @param  string $email
     * @return array
     */
    public function getByEmail(string $email);
}
