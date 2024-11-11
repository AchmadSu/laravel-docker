<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
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

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get All User
     *
     * @return array
     */
    public function getAll()
    {
        $data = $this->model->get();
        return $data->toArray();
    }

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
     * Get User By Email
     *
     * @param  string $email
     * @return array
     */
    public function getUserByEmail(string $email)
    {
        return $this->model->where('email', $email)->get()->first();
    }
}
