<?php

namespace App\Services\Module;

use LaravelEasyRepository\BaseService;

interface ModuleService extends BaseService
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
     * @return void
     */
    public function getByCode(string $code);

    /**
     * createModules
     *
     * @param  mixed $data
     * @return array
     */
    public function create($data);

    /**
     * update
     *
     * @param  int $id
     * @param  array $data
     * @return array
     */
    public function update($id, array $data);

    /**
     * destroy
     *
     * @param  array $id
     * @return array
     */
    public function destroy(array $id);
}
