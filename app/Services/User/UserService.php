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
     * @return array
     */
    public function getAll();

    /**
     * checkEmail
     *
     * @param  mixed $email
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
     * validateRegister
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function validateRegister($input);
}
