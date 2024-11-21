<?php

namespace App\Services\Publisher;

use LaravelEasyRepository\Service;
use App\Repositories\Publisher\PublisherRepository;

class PublisherServiceImplement extends Service implements PublisherService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(PublisherRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
