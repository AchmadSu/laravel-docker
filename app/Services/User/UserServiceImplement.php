<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  /**
   * __construct
   *
   * @param App\Repositories\User\UserRepository $mainRepository
   * @return void
   */
  public function __construct(UserRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  /**
   * Get ALl User Data
   *
   * @return array
   */
  public function getALl(Request $request)
  {
    $this->setMessage("Displaying all user data");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getAll($request)
      ];
      $this->setData($data);
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  public function getUserById(int $id)
  {
    $this->setMessage("Displaying user data by ID");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getUserById($id)
      ];
      $this->setData($data);
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }
    $this->setResponse();
    return $this->getResponse();
  }

  /**
   * getUserByEmail
   *
   * @param  string $email
   * @return array
   */
  public function getUserByEmail(string $email)
  {
    $this->setMessage("Displaying user data by email");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getUserByEmail($email)
      ];
      $this->setData($data);
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  /**
   * login
   *
   * @param  string $email
   * @param  string $password
   * @return array
   */
  public function login($email, $password)
  {
    $this->setMessage("Login successfully!");
    $data = array();

    $credentials = ['email' => $email, 'password' => $password];
    try {
      $checkData = Auth::attempt($credentials);
      if ($checkData) {
        $user = Auth::user();
        $token = $user->createToken('token-name', ['server:update'])->plainTextToken;
        $data = [
          "user" => $user,
          "token" => $token
        ];
        $this->setData($data);
      } else {
        $this->setError(401, "Unauthorized. Please check email or password!");
      }
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  public function logout(Request $request)
  {
    $this->setMessage("Logout Successfuly!");
    try {
      $request->user()->currentAccessToken()->delete();
      $this->setIsSuccess(true);
      $this->setStatusCode(200);
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }
  }

  /**
   * addUser
   *
   * @param Illuminate\Http\Request $request
   * @return array
   */
  public function addUser(Request $request)
  {
    $this->setMessage("Add user successfully, Please login!");

    try {
      $validateData = validateUserRegister($request);
      if ($validateData['isSuccess']) {
        $this->mainRepository->addUser($request);
      } else {
        $this->setError($validateData['statusCode'], $validateData['message']);
      }
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  /**
   * updateUser
   *
   * @param  Illuminate\Http\Request $request
   * @return array
   */
  public function updateUser(Request $request)
  {
    $this->setMessage("Update user successfully!");
    try {
      $validateData = validateUpdateUser($request);
      if ($validateData['isSuccess']) {
        $this->mainRepository->updateUser($validateData['updateData'], Auth::user()->id);
        if (isset($validateData['isEmailChanges']) && $validateData['isEmailChanges']) {
          $this->logout($request);
          if ($this->getStatusCode() === 200 && $this->getIsSuccess()) {
            $message = "Update user with email changes, you have to relog in! " . $this->getMessage();
            $this->setMessage($message);
          } else {
            throw new \Exception($this->getMessage(), $this->getStatusCode());
          }
        }
      } else {
        $this->setError($validateData['statusCode'], $validateData['message']);
      }
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }
    $this->setResponse();
    return $this->getResponse();
  }
}
