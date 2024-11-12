<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    private $headers;

    /**
     * __construct
     *
     * @param  App\Services\User\UserService $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * get All User
     *
     * @param Illuminate\Http\Request $request
     * @return response json
     */
    public function index(Request $request)
    {
        $email = $request->query('email');
        if (!empty($email)) {
            $response = $this->userService->getUserByEmail($email);
        } else {
            $response = $this->userService->getAll($request);
        }
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    /**
     * getUserByEmail
     *
     * @param  string $email
     * @return response json
     */
    public function getUserByEmail(string $email)
    {
        $response = $this->userService->getUserByEmail($email);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    /**
     * login
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $response = $this->userService->login($email, $password);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    /**
     * addUser
     *
     * @param  Illuminate\Http\Request $request
     * @return response json
     */
    public function addUser(Request $request)
    {
        $response = $this->userService->addUser($request);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    /**
     * updateUser
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function updateUser(Request $request)
    {
        $response = $this->userService->updateUser($request);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }
}
