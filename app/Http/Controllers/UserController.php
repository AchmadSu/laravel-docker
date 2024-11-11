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
     * @param  mixed $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * get All User
     *
     * @return response json
     */
    public function index(Request $request)
    {
        $email = $request->query('email');
        if (!empty($email)) {
            $response = $this->userService->getUserByEmail($email);
        } else {
            $response = $this->userService->getAll();
        }
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    /**
     * getUserByEmail
     *
     * @param  mixed $email
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
     * addUser
     *
     * @param  mixed $request
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
}
