<?php

namespace App\Services\AuthorLog;

use LaravelEasyRepository\Service;
use App\Repositories\AuthorLog\AuthorLogRepository;

class AuthorLogServiceImplement extends Service implements AuthorLogService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(AuthorLogRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
