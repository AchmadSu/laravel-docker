<?php

namespace App\Repositories\Genre;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Genre;

class GenreRepositoryImplement extends Eloquent implements GenreRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Genre $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
