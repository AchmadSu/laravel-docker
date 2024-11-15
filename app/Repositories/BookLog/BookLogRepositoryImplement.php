<?php

namespace App\Repositories\BookLog;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\BookLog;

class BookLogRepositoryImplement extends Eloquent implements BookLogRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(BookLog $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
