<?php

namespace App\Repositories\ModuleLesson;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ModuleLesson;

class ModuleLessonRepositoryImplement extends Eloquent implements ModuleLessonRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(ModuleLesson $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $modelLesson = $this->model->where('id', $id);
        $modelLesson->update($data);
    }

    public function destroy(array $ids)
    {
        $this->model->destroy($ids);
    }

    public function destroyByModuleIds(array $module_ids)
    {
        $this->model->whereIn('module_id', $module_ids)->delete();
    }

    public function destroyByLessonIds(array $lesson_ids)
    {
        $this->model->whereIn('lesson_id', $lesson_ids)->delete();
    }
}
