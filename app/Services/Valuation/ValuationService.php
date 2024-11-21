<?php

namespace App\Services\Valuation;

use LaravelEasyRepository\BaseService;

interface ValuationService extends BaseService
{

    /**
     * getAll
     *
     * @param  mixed|array $param
     * @return array
     */
    public function getAll(array $param);

    /**
     * create
     *
     * @param  mixed|array $data
     * @return array
     */
    public function create($data);

    /**
     * update
     *
     * @param  int $id
     * @param  mixed|array $data
     * @return void
     */
    public function update($id, array $data);

    /**
     * destroy
     *
     * @param  mixed|array $ids
     * @return array
     */
    public function destroy(array $ids);
}
