<?php

namespace App\Services\ModuleLesson;

use LaravelEasyRepository\BaseService;

interface ModuleLessonService extends BaseService
{

    /**
     * create
     *
     * @param  mixed $data
     * @return array
     */
    public function create($data);

    /**
     * update
     *
     * @param  int $id
     * @param  array $data
     * @return array
     */
    public function update($id, array $data);
}
