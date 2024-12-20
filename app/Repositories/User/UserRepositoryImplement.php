<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    /**
     * __construct
     *
     * @param  App\Models\User $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get All User
     *
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function getAll(Request $request)
    {
        try {
            $data = $this->model
                ->when(isset($request->keyword), function ($query) use ($request) {
                    $newQuery = $query
                        ->where('name', 'LIKE', '%' . $request->keyword . '%')
                        ->orwhere('email', 'LIKE', '%' . $request->keyword . '%');
                    return $newQuery;
                })
                ->when(isset($request->orderBy), function ($query) use ($request) {
                    return $query->orderBy($request->orderBy, $request->sort);
                })
                ->get();
            $result['total'] = $data->count();
            $data = $data
                ->when(isset($request->skip), function ($query) use ($request) {
                    return $query->skip($request->skip);
                })
                ->when(isset($request->take), function ($query) use ($request) {
                    return $query->take($request->take);
                });
            $result['data'] = array_values($data->toArray());
            return $result;
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * getUserById
     *
     * @param  int $id
     * @return array
     */
    public function getUserById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * Get User By Email
     *
     * @param  string $email
     * @return array
     */
    public function getUserByEmail(string $email)
    {
        try {
            return $this->model->where('email', $email)->get()->first();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * addUser
     *
     * @param  Illuminate\Http\Request $request
     * @return array
     */
    public function addUser(Request $request)
    {
        $input = $request->all();
        $input['name'] = ucwords(strtolower($input['name']));
        $input['password'] = bcrypt($input['password']);
        $input['email'] = $input['email'];
        $data = $this->model->create($input);
        return $data;
    }

    /**
     * updateUser
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     */
    public function updateUser(array $data, int $id)
    {
        $user = $this->model->where('id', $id);
        $user->update($data);
    }
}
