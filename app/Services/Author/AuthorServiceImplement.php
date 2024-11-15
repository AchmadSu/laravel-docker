<?php

namespace App\Services\Author;

use LaravelEasyRepository\Service;
use App\Repositories\Author\AuthorRepository;

class AuthorServiceImplement extends Service implements AuthorService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(AuthorRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
