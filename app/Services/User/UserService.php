<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{

    /**
     * getAll
     *
     * @param Illuminate\Http\Request $request
     * @return array
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
     * @param  mixed $email
     * @return array
     */
    public function getUserByEmail(string $email);

    /**
     * login
     *
     * @param  string $email
     * @param  string $password
     * @return array
     */
    public function login($email, $password);

    /**
     * logout
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function logout(Request $request);

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
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function updateUser(Request $request);
}
