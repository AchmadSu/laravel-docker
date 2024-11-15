<?php

namespace App\Services\Author;

use LaravelEasyRepository\Service;
use App\Repositories\Author\AuthorRepository;
use Illuminate\Http\Request;

class AuthorServiceImplement extends Service implements AuthorService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(AuthorRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  /**
   * getAllAuthor
   *
   * @param  Illuminate\Http\Request $request
   * @return array
   */
  public function getAll(Request $request)
  {
    $this->setMessage("Displaying all author data");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getAll($request)
      ];
    } catch (\Exception $e) {
      $this->setError($e->getCode(), $e->getMessage());
    }

    $this->setResponse($data);
    return $this->getResponse();
  }

  /**
   * getByAuthorId
   *
   * @param  int $id
   * @return array
   */
  public function getById(int $id)
  {
    $this->setMessage("Displaying all author data");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getById($id)
      ];
    } catch (\Exception $e) {
      $this->setError($e->getCode(), $e->getMessage());
    }

    $this->setResponse($data);
    return $this->getResponse();
  }

  /**
   * getByAuthorEmail
   *
   * @param  string $email
   * @return array
   */
  public function getByEmail(String $email)
  {
    $this->setMessage("Displaying all author data");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getByEmail($email)
      ];
    } catch (\Exception $e) {
      $this->setError($e->getCode(), $e->getMessage());
    }

    $this->setResponse($data);
    return $this->getResponse();
  }
}
