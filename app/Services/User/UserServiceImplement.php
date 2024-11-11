<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  private $statusCode;
  private $isSuccess;
  private $message;

  /**
   * __construct
   *
   * @param  mixed $mainRepository
   * @return void
   */
  public function __construct(UserRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->statusCode = 200;
    $this->isSuccess = true;
    $this->message = "";
  }

  /**
   * setError
   *
   * @param  int $statusCode
   * @param  string $message
   * @return void
   */
  public function setError(int $statusCode, string $message)
  {
    $this->statusCode = $statusCode;
    $this->isSuccess = false;
    $this->message = "Request failed. Error: " . $message;
  }

  /**
   * Get ALl User Data
   *
   * @return array
   */
  public function getALl()
  {
    $this->message = "Displaying all user data";
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getAll()
      ];
    } catch (\Exception $e) {
      $this->setError($e->getCode(), $e->getMessage());
    }

    $setResponse = $this->setArrayResponse($this->statusCode, $this->isSuccess, $this->message);
    return $this->setResponse($setResponse, $data);
  }

  /**
   * getUserByEmail
   *
   * @param  string $email
   * @return array
   */
  public function getUserByEmail(string $email)
  {
    $this->message = "Displaying user data by email";
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getUserByEmail($email)
      ];
    } catch (\Exception $e) {
      $this->setError($e->getCode(), $e->getMessage());
    }

    $setResponse = $this->setArrayResponse($this->statusCode, $this->isSuccess, $this->message);
    return $this->setResponse($setResponse, $data);
  }

  /**
   * addUser
   *
   * @param Illuminate\Http\Request $request
   * @return array
   */
  public function addUser(Request $request)
  {
    $this->message = "Add user successfully, Please login!";
    try {
      $validateData = $this->validateRegister($request);
      if ($validateData['isSuccess']) {
        $this->mainRepository->addUser($request);
      } else {
        $this->setError($validateData['statusCode'], $validateData['message']);
      }
    } catch (\Exception $e) {
      $this->setError($e->getCode(), $e->getMessage());
    }
    $setResponse = $this->setArrayResponse($this->statusCode, $this->isSuccess, $this->message);
    return $this->setResponse($setResponse);
  }

  public function validateRegister($input)
  {
    $data = [
      'name' => $input['name'],
      'email' => $input['email'],
      'password' => $input['password'],
      'confirm_pass' => $input['confirm_pass']
    ];

    $rules = [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => [
        'required',
        'string',
        'min:8',
        'regex:/[A-Z]/',
        'regex:/[a-z]/',
        'regex:/[0-9]/',
        'regex:/[@$!%*?&]/',
      ],
      'confirm_pass' => 'required|same:password'
    ];

    $response = $this->validateData($data, $rules);
    return $response;
  }
}
