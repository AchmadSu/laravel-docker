<?php

namespace App\Services\Lesson;

use LaravelEasyRepository\Service;
use App\Repositories\Lesson\LessonRepository;

class LessonServiceImplement extends Service implements LessonService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(LessonRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getAll($param)
  {
    $this->setMessage("Displaying all lesson data");

    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getAll($param)
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
    $this->setMessage("Displaying lesson data by ID");

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

  public function getByCode(string $code)
  {
    $this->setMessage("Displaying lesson data by code: " . $code);

    $data = array();
    try {
      $data = [
        "data" => $this->mainRepository->getByCode($code)
      ];
      $this->setData($data);
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  /**
   * create
   *
   * @param  array $data
   * @return array
   */
  public function create($data)
  {
    $this->setMessage("Add lesson successfully!");

    try {
      $validateData = validateCreateLesson($data);
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

  public function update($id, array $data)
  {
    $this->setMessage("Update lesson successfully!");

    try {
      $validateData = validateUpdateLesson($data);
      if ($validateData['isSuccess']) {
        $this->mainRepository->update($id, $data);
      } else {
        $this->setError($validateData['statusCode'], $validateData['message']);
      }
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }

    $this->setResponse();
    return $this->getResponse();
  }

  public function destroy(array $ids)
  {
    $this->setMessage("");
    try {
      $executeDestroy = $this->mainRepository->destroy($ids);
      $this->setMessage($executeDestroy['message']);
      if (!$executeDestroy['isSuccess']) {
        $this->setError($executeDestroy['statusCode'], $executeDestroy['message']);
      }
    } catch (\Exception $e) {
      $this->setError((int)$e->getCode(), $e->getMessage());
    }
    $this->setResponse();
    return $this->getResponse();
  }
}
