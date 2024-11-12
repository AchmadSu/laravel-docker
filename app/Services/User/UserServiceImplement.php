<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
   * @param App\Repositories\User\UserRepository $mainRepository
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
    $statusCode = ($statusCode >= 300 and $statusCode <= 500) ? $statusCode : 500;
    $this->statusCode = $statusCode;
    $this->isSuccess = false;
    $this->message = "Request failed. Error: " . $message;
  }

  /**
   * Get ALl User Data
   *
   * @return array
   */
  public function getALl(Request $request)
  {
    $this->message = "Displaying all user data";
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getAll($request)
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
   * login
   *
   * @param  string $email
   * @param  string $password
   * @return array
   */
  public function login($email, $password)
  {
    $this->message = "Login successfuly!";
    $data = array();

    $credentials = ['email' => $email, 'password' => $password];
    $checkData = Auth::attempt($credentials);
    if ($checkData) {
      $user = Auth::user();
      $token = $user->createToken('token-name', ['server:update'])->plainTextToken;
      $data = [
        "user" => $user,
        "token" => $token
      ];
    } else {
      $this->setError(401, "Unauthorized. Please check email or password!");
    }

    $setResponse = $this->setArrayResponse($this->statusCode, $this->isSuccess, $this->message);
    return $this->setResponse($setResponse, $data);
  }

  public function logout(Request $request)
  {
    $this->message = "Logout Successfuly!";
    $request->user()->currentAccessToken()->delete();
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

  public function updateUser(Request $request)
  {
    $this->message = "Update user successfully!";
    try {
      $validateData = $this->validateUpdate($request);
      if ($validateData['isSuccess']) {
        $this->mainRepository->updateUser($validateData['updateData'], Auth::user()->id);
        if (isset($validateData['isEmailChanges']) && $validateData['isEmailChanges']) {
          $this->logout($request);
          $this->message = "Update user with email changes, you have to relog in! " . $this->message;
        }
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

  public function validateUpdate($input)
  {
    $data = [
      'name' => $input['name'],
      'old_password' => $input['old_password']
    ];

    $rules = [
      'name' => 'required',
      'old_password' => [
        'required',
        function ($attribute, $value, $fail) {
          if (!Hash::check($value, Auth::user()->password)) {
            $fail('The current password is incorect.');
          }
        },
      ]
    ];

    if (isset($input['new_password'])) {
      $passData = [
        'new_password' => $input['new_password'],
        'confirm_pass' => $input['confirm_pass']
      ];
      $passRules = [
        'new_password' =>
        [
          'required',
          'string',
          'min:8',
          'regex:/[A-Z]/',
          'regex:/[a-z]/',
          'regex:/[0-9]/',
          'regex:/[@$!%*?&]/',
        ],
        'confirm_pass' => 'required|same:new_password'
      ];
      $this->addKeyValue($data, $passData);
      $this->addKeyValue($rules, $passRules);
    }

    if (isset($input['email']) && $input['email'] !== Auth::user()->email) {
      $emailData = ['email' => $input['email']];
      $emailRules = ['email' => 'required|email|unique:users,email'];
      $this->addKeyValue($data, $emailData);
      $this->addKeyValue($rules, $emailRules);
    }

    $updateArray = array();
    $response = $this->validateData($data, $rules);
    if ($response['isSuccess']) {
      if (isset($input['email']) && $input['email'] !== Auth::user()->email) {
        $emailData = ['email' => $input['email']];
        $this->addKeyValue($updateArray, $emailData);
        $response['isEmailChanges'] = true;
      }
      if (isset($input['name'])) {
        $nameData = ['name' => ucwords(strtolower($input['name']))];
        $this->addKeyValue($updateArray, $nameData);
      }
      if (isset($input['new_password'])) {
        $passData = ['password' => bcrypt($input['new_password'])];
        $this->addKeyValue($updateArray, $passData);
      }
      $response['updateData'] = $updateArray;
    }
    return $response;
  }
}
