<?php

namespace App\Repositories\Author;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface AuthorRepository extends Repository
{

    /**
     * getAllAuthor
     *
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
     * @param  string $id
     * @return array
     */
    public function getByEmail(string $email);
}
