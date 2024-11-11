<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    /**
     * getAll
     *
     * @return void
     */
    public function getAll();

    /**
     * addUser
     *
     * @return void
     */
    public function addUser(Request $request);

    /**
     * checkEmail
     *
     * @param  string $email
     * @return array
     */
    public function getUserByEmail(string $email);
}
