<?php

namespace App\Repositories\Valuation;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Valuation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ValuationRepositoryImplement extends Eloquent implements ValuationRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Valuation $model)
    {
        $this->model = $model;
    }

    public function getAll(array $param)
    {
        try {
            $data = $this->model
                ->select(
                    'valuations.id as id',
                    'valuations.point as point',
                    'valuations.created_at as created_at',
                    'valuations.updated_at as updated_at',
                    'users.id as user_id',
                    'users.name as name',
                    'modules.id as module_id',
                    'modules.code as module_code',
                    'modules.name as module',
                    'lessons.id as lesson_id',
                    'lessons.code as lesson_code',
                    'lessons.name as lesson'
                )
                ->join('users', 'valuations.user_id', '=', 'users.id')
                ->join('modules', 'valuations.module_id', '=', 'modules.id')
                ->join('lessons', 'valuations.lesson_id', '=', 'lessons.id')
                ->when(isset($param['keyword']), function ($query) use ($param) {
                    $query->where(function ($subQuery) use ($param) {
                        $subQuery
                            ->where('modules.name', 'LIKE', '%' . $param['keyword'] . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $param['keyword'] . '%')
                            ->orWhere('lessons.code', 'LIKE', '%' . $param['keyword'] . '%');
                    });
                })
                ->when(
                    isset($param['point_greater']) && !isset($param['point_less']),
                    function ($query) use ($param) {
                        $query->where(function ($subQuery) use ($param) {
                            $subQuery->where('valuations.point', '>', $param['point_greater']);
                        });
                    }
                )
                ->when(
                    isset($param['point_less']) && !isset($param['point_greater']),
                    function ($query) use ($param) {
                        $query->where(function ($subQuery) use ($param) {
                            $subQuery->where('valuations.point', '<', $param['point_less']);
                        });
                    }
                )
                ->when(
                    isset($param['point_greater']) && isset($param['point_less']),
                    function ($query) use ($param) {
                        $query->where(function ($subQuery) use ($param) {
                            $subQuery
                                ->where('valuations.point', '>=', $param['point_less'])
                                ->where('valuations.point', '<=', $param['point_greater']);
                        });
                    }
                )
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

    public function create($data)
    {
        $data['user_id'] = (int) $data['user_id'];
        $data['module_id'] = (int) $data['module_id'];
        $data['lesson_id'] = (int) $data['lesson_id'];
        $data['point'] = (float) $data['point'];
        $this->model->create($data);
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
