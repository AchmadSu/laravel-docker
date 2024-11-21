<?php

namespace App\Repositories\ModuleLesson;

use LaravelEasyRepository\Repository;

interface ModuleLessonRepository extends Repository
{

    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create($data);

    /**
     * update
     *
     * @param  int $id
     * @param  array $data
     * @return void
     */
    public function update($id, array $data);

    /**
     * destroy
     *
     * @param  array $ids
     * @return void
     */
    public function destroy(array $ids);

    /**
     * destroyByModuleIds
     *
     * @param  array|int $module_ids
     * @return void
     */
    public function destroyByModuleIds(array $module_ids);

    /**
     * destroyByLessonIds
     *
     * @param  array|int $lesson_ids
     * @return void
     */
    public function destroyByLessonIds(array $lesson_ids);
}
