<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    /**
     * getAll
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function getAll(Request $request);

    /**
     * getUserById
     *
     * @param  int $id
     * @return array
     */
    public function getUserById(int $id);

    /**
     * checkEmail
     *
     * @param  string $email
     * @return array
     */
    public function getUserByEmail(string $email);

    /**
     * addUser
     *
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function addUser(Request $request);

    /**
     * updateUser
     *
     * @param  array $data
     * @param int $id
     * @return array
     */
    public function updateUser(array $data, int $id);
}
