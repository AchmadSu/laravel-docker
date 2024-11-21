<?php

namespace App\Repositories\Valuation;

use LaravelEasyRepository\Repository;

interface ValuationRepository extends Repository
{

    /**
     * getAll
     *
     * @param  array $param
     * @return array
     */
    public function getAll(array $param);

    // /**
    //  * getById
    //  *
    //  * @param  int $id
    //  * @return array
    //  */
    // public function getById(int $id);

    /**
     * create
     *
     * @param  mixed|array $data
     * @return void
     */
    public function create($data);

    /**
     * update
     *
     * @param int $id
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
