<?php

namespace App\Services\Book;

use LaravelEasyRepository\Service;
use App\Repositories\Book\BookRepository;
use Illuminate\Http\Request;

class BookServiceImplement extends Service implements BookService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(BookRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getAll(Request $request)
  {
    $this->setMessage("Displaying all book data");
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

  public function getById(int $id)
  {
    $this->setMessage("Displaying all book data");
    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getById($id)
      ];
      $this->setData($data);
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  public function create($data)
  {
    $this->setMessage("Create book successfully!");
    try {
      $validateData = validateCreateBook($data);
      if ($validateData['isSuccess']) {
        $this->mainRepository->create($data);
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
