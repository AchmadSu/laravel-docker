<?php

namespace App\Http\Controllers;

use App\Services\Module\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    private $moduleService;

    /**
     * __construct
     *
     * @param  App\Services\Module\ModuleService $moduleService
     * @return void
     */
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index(Request $request)
    {
        $id = $request->query('id');
        $code = $request->query('code');
        $param = $request->all();

        if (!empty($id)) {
            $response = $this->moduleService->getById($id);
        } else if (!empty($code)) {
            $response = $this->moduleService->getByCode($code);
        } else {
            $response = $this->moduleService->getAll($param);
        }
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $response = $this->moduleService->create($data);

        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $response = $this->moduleService->update($data['id'], $data);

        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $response = $this->moduleService->destroy($data['ids']);

        return response()->json(
            $response,
            $response['statusCode']
        );
    }
}
