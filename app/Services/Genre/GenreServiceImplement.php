<?php

namespace App\Services\Genre;

use LaravelEasyRepository\Service;
use App\Repositories\Genre\GenreRepository;

class GenreServiceImplement extends Service implements GenreService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(GenreRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
