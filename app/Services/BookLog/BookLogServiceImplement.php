<?php

namespace App\Services\BookLog;

use LaravelEasyRepository\Service;
use App\Repositories\BookLog\BookLogRepository;

class BookLogServiceImplement extends Service implements BookLogService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(BookLogRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
