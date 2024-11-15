<?php

namespace App\Services\City;

use LaravelEasyRepository\Service;
use App\Repositories\City\CityRepository;

class CityServiceImplement extends Service implements CityService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CityRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
