<?php

namespace App\Repositories\Book;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BookRepositoryImplement extends Eloquent implements BookRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function getAll(Request $request)
    {
        try {
            $data = $this->model->get();
            $data = $data
                ->when(isset($request->skip), function ($query) use ($request) {
                    return $query->skip($request->skip);
                })
                ->when(isset($request->take), function ($query) use ($request) {
                    return $query->take($request->take);
                });
            return array_values($data->toArray());
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
}
