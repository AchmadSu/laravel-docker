<?php

namespace App\Repositories\Lesson;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Lesson;
use App\Models\ModuleLesson as ModelsModuleLesson;
use Illuminate\Support\Facades\DB;
use App\Repositories\ModuleLesson;
use App\Repositories\ModuleLesson\ModuleLessonRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LessonRepositoryImplement extends Eloquent implements LessonRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;
    private $moduleLesson;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
        $this->moduleLesson = app(ModuleLessonRepository::class);
    }

    public function getAll($param)
    {
        try {
            $data = $this->model
                ->when(isset($param['keyword']), function ($query) use ($param) {
                    $newQuery = $query
                        ->where('name', 'LIKE', '%' . $param['keyword'] . '%')
                        ->orWhere('code', 'LIKE', '%' . $param['keyword'] . '%')
                        ->orWhere('desc', 'LIKE', '%' . $param['keyword'] . '%');
                    return $newQuery;
                })->when(isset($param['paginate']), function ($query) use ($param) {
                    return $query->paginate($param['paginate']);
                })
                ->when(!isset($param['paginate']), function ($query) {
                    return $query->paginate(10);
                });
            return $data;
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function getById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function getByCode(string $code)
    {
        try {
            return $this->model->where('code', $code)->get()->first();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function create($data)
    {
        DB::transaction(function () use ($data) {
            $module_id = $data['module_id'];
            unset($data['module_id']);
            $data['code'] = 'less_' . getMaxLessonCodeNumber();
            $lesson = $this->model->create($data);
            $moduleLesson = [
                'module_id' => $module_id,
                'lesson_id' => $lesson->id
            ];
            $this->moduleLesson->create($moduleLesson);
        });
    }

    public function update($id, array $data)
    {
        $lesson = $this->model->where('id', $id);
        if ($lesson->count() > 0) {
            DB::transaction(function () use ($data, $lesson, $id) {
                $module_id = isset($data['module_id']) ? $data['module_id'] : 0;
                if (isset($data['module_id'])) {
                    $module_id = $data['module_id'];
                    unset($data['module_id']);
                }
                $lesson->update($data);
                if ($module_id !== 0) {
                    $moduleLesson = [
                        'module_id' => $module_id,
                        'lesson_id' => $id
                    ];
                    $this->moduleLesson->create($moduleLesson);
                }
            });
        } else {
            throw new \Exception("Update failed. There's no data have been selected", 404);
        }
    }

    /**
     * destroy
     *
     * @param  array $ids
     * @return array
     */
    public function destroy(array $ids)
    {
        $response = array();
        $data = $this->model->findMany($ids);
        if ($data->count() > 0) {
            try {
                DB::transaction(function () use ($ids) {
                    $this->moduleLesson->destroyByLessonIds($ids);
                    $this->model->destroy($ids);
                });
                $response['statusCode'] = 200;
                $response['isSuccess'] = true;
                $response['message'] = "Delete data successfully";
            } catch (\Exception $e) {
                $response['statusCode'] = (int) $e->getCode();
                $response['isSuccess'] = false;
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['statusCode'] = 404;
            $response['isSuccess'] = false;
            $response['message'] = "Delete data failed. There's no data have been selected!";
        }
        return $response;
    }
}
