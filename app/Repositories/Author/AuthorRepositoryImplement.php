<?php

namespace App\Repositories\Author;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Author;

class AuthorRepositoryImplement extends Eloquent implements AuthorRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
