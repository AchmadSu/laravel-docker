<?php

namespace App\Services\ModuleLesson;

use LaravelEasyRepository\Service;
use App\Repositories\ModuleLesson\ModuleLessonRepository;

class ModuleLessonServiceImplement extends Service implements ModuleLessonService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(ModuleLessonRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function create($data)
  {
    try {
      $this->mainRepository->create($data);
    } catch (\Exception $e) {
      $this->setError((int) $e->getCode(), $e->getMessage());
    }
  }

  public function update($id, array $data)
  {
    try {
      $this->mainRepository->update($id, $data);
    } catch (\Exception $e) {
      $this->setError((int) $e->getCode(), $e->getMessage());
    }
  }
}
