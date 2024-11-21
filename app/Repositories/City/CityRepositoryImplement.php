<?php

namespace App\Repositories\City;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\City;

class CityRepositoryImplement extends Eloquent implements CityRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
