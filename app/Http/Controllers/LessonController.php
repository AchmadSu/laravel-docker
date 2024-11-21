<?php

namespace App\Http\Controllers;

use App\Services\Lesson\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }
    public function index(Request $request)
    {
        $id = $request->query('id');
        $code = $request->query('code');
        $param = $request->all();

        if (!empty($id)) {
            $response = $this->lessonService->getById($id);
        } else if (!empty($code)) {
            $response = $this->lessonService->getByCode($code);
        } else {
            $response = $this->lessonService->getAll($param);
        }
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $response = $this->lessonService->create($data);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $response = $this->lessonService->update($data['id'], $data);
        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $response = $this->lessonService->destroy($data['ids']);

        return response()->json(
            $response,
            $response['statusCode']
        );
    }
}
