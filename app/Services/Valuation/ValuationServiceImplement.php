<?php

namespace App\Services\Valuation;

use LaravelEasyRepository\Service;
use App\Repositories\Valuation\ValuationRepository;

class ValuationServiceImplement extends Service implements ValuationService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(ValuationRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getAll(array $param)
  {
    $this->setMessage("Displaying all valuation data");

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

  public function create($data)
  {
    $this->setMessage("Create valuation successfully!");
    try {
      $validateData = validateCreateValuation($data);
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
    $this->setMessage("Update module successfully!");
    try {
      $validateData = validateCreateValuation($data);
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
