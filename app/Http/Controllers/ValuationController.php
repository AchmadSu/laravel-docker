<?php

namespace App\Http\Controllers;

use App\Services\Valuation\ValuationService;
use Illuminate\Http\Request;

class ValuationController extends Controller
{
    private $valuationService;
    public function __construct(ValuationService $valuationService)
    {
        $this->valuationService = $valuationService;
    }

    public function index(Request $request)
    {
        // $id = $request->query('id');
        // $code = $request->query('code');
        $param = $request->all();

        // if (!empty($id)) {
        //     $response = $this->valuationService->getById($id);
        // } else if (!empty($code)) {
        //     $response = $this->valuationService->getByCode($code);
        // } else {
        //     $response = $this->valuationService->getAll($param);
        // }
        $response = $this->valuationService->getAll($param);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $response = $this->valuationService->create($data);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $response = $this->valuationService->update($data['id'], $data);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function destroy(Request $request)
    {
        $data = $request->all();

        $response = $this->valuationService->destroy($data['ids']);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }
}
