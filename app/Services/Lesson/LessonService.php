<?php

namespace App\Services\Lesson;

use LaravelEasyRepository\BaseService;

interface LessonService extends BaseService
{

    /**
     * getAll
     *
     * @param  mixed $param
     * @return array
     */
    public function getAll($param);

    /**
     * getById
     *
     * @param  int $id
     * @return void
     */
    public function getById(int $id);

    /**
     * getByCode
     *
     * @param  string $code
     * @return void
     */
    public function getByCode(string $code);

    /**
     * create
     *
     * @param  array $data
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

    /**
     * destroy
     *
     * @param  array $ids
     * @return array
     */
    public function destroy(array $ids);
}
