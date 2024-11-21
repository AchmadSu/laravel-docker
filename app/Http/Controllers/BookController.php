<?php

namespace App\Http\Controllers;

use App\Services\Book\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;

    /**
     * __construct
     *
     * @param  App\Services\Book\BookService $bookService
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        $id = $request->query('id');
        if (!empty($id)) {
            $response = $this->bookService->getById($id);
        } else {
            $response = $this->bookService->getAll($request);
        }

        return response()->json(
            $response,
            $response['statusCode']
        );
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $response = $this->bookService->create($data);

        return response()->json(
            $response,
            $response['statusCode']
        );
    }
}
