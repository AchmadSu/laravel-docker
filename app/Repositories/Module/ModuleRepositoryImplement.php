<?php

namespace App\Repositories\Module;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Module;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModuleRepositoryImplement extends Eloquent implements ModuleRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getAll($param)
    {
        try {
            $data = $this->model
                ->when(isset($param['keyword']), function ($query) use ($param) {
                    $query->where(function ($subQuery) use ($param) {
                        $subQuery
                            ->where('modules.name', 'LIKE', '%' . $param['keyword'] . '%')
                            ->orWhere('modules.code', 'LIKE', '%' . $param['keyword'] . '%')
                            ->orWhere('modules.desc', 'LIKE', '%' . $param['keyword'] . '%');
                    });
                })
                ->select(
                    'modules.id as id',
                    'modules.code as code',
                    'modules.name as module',
                    'modules.desc as desc',
                    'modules.created_at as created_at',
                    'modules.updated_at as updated_at'
                )
                ->with(['lessons' => function ($query) {
                    $query->select(
                        'lessons.id as lesson_id',
                        'lessons.name as lesson',
                        'lessons.code as lesson_code'
                    );
                }])
                ->when(isset($param['paginate']), function ($query) use ($param) {
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
        $data['code'] = 'mod_' . getMaxModuleCodeNumber();
        $result = $this->model->create($data);
        return $result;
    }

    public function update($id, array $data)
    {
        $module = $this->model->where('id', $id);
        if ($module->count() > 0) {
            $module->update($data);
        } else {
            throw new \Exception("Update failed. There's no data have been selected", 404);
        }
    }

    public function destroy(array $ids)
    {
        $response = array();
        $data = $this->model->findMany($ids);
        if ($data->count() > 0) {
            try {
                $this->model->destroy($ids);
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
