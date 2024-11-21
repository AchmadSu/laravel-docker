<?php

namespace App\Repositories\Module;

use LaravelEasyRepository\Repository;

interface ModuleRepository extends Repository
{

    /**
     * getAll
     *
     * @param  mixed $param
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
     * createModules
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
     * @param  mixed $ids
     * @return void
     */
    public function destroy(array $ids);
}
