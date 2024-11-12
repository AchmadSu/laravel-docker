<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{

    /**
     * setError
     *
     * @param  int $statusCode
     * @param  bool $isSuccess
     * @param  string $message
     * @return void
     */
    public function setError(int $statusCode, string $message);

    /**
     * getAll
     *
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function getAll(Request $request);

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

    /**
     * validateRegister
     *
     * @param  mixed $input
     * @return array
     */
    public function validateRegister($input);

    /**
     * validateUpdate
     *
     * @param  mixed $input
     * @return array
     */
    public function validateUpdate($input);
}
