<?php

namespace App\Repositories\Lesson;

use LaravelEasyRepository\Repository;

interface LessonRepository extends Repository
{

    /**
     * getAll
     *
     * @param  mixed $data
     * @return array
     */
    public function getAll($param);

    /**
     * getById
     *
     * @param  int $id
     * @return array
     */
    public function getById(int $id);

    /**
     * getByCode
     *
     * @param  string $code
     * @return array
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
