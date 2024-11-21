<?php

namespace App\Repositories\Author;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthorRepositoryImplement extends Eloquent implements AuthorRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    /**
     * getAllAuthors
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
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

    /**
     * getByAuthorId
     *
     * @param  int $id
     * @return array
     */
    public function getById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * getByAuthorEmail
     *
     * @param  string $email
     * @return array
     */
    public function getByEmail(string $email)
    {
        try {
            return $this->model->where('email', $email)->get()->first();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }
}
