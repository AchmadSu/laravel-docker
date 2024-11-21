<?php

namespace App\Repositories\Country;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Country;

class CountryRepositoryImplement extends Eloquent implements CountryRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
