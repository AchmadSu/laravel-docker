<?php

namespace App\Services\Country;

use LaravelEasyRepository\Service;
use App\Repositories\Country\CountryRepository;

class CountryServiceImplement extends Service implements CountryService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CountryRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
