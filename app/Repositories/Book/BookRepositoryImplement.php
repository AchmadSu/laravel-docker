<?php

namespace App\Repositories\Book;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Book;
use Hamcrest\Arrays\IsArray;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class BookRepositoryImplement extends Eloquent implements BookRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function getAll(Request $request)
    {
        try {
            $data = $this->model
                ->select(
                    'books.id as id',
                    'books.code as code',
                    'title',
                    'year',
                    'volume',
                    'books.author_id as author_id',
                    'authors.name as author_name',
                    'books.city_id as city_id',
                    'cities.name as city',
                    'books.publisher_id as publisher_id',
                    'publishers.name as publisher'
                )
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->join('cities', 'books.city_id', '=', 'cities.id')
                ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                ->when(isset($request->keyword), function ($query) use ($request) {
                    $newQuery = $query
                        ->where('title', 'LIKE', '%' . $request->keyword . '%')
                        ->orwhere('books.code', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('authors.name', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('publishers.name', 'LIKE', '%' . $request->keyword . '%');
                    return $newQuery;
                })
                ->when(isset($request->year), function ($query) use ($request) {
                    return $query->where('year', '=', (int)$request->year);
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

    public function getById(int $id)
    {
        try {
            return $this->model
                ->select(
                    'books.id as id',
                    'books.code as code',
                    'title',
                    'year',
                    'volume',
                    'books.author_id as author_id',
                    'authors.name as author_name',
                    'books.city_id as city_id',
                    'cities.name as city',
                    'books.publisher_id as publisher_id',
                    'publishers.name as publisher'
                )
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->join('cities', 'books.city_id', '=', 'cities.id')
                ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                ->where('books.id', $id)
                ->get();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function create($data)
    {
        $data['code'] = strtoupper($data['code']);
        $data['title'] = ucwords(strtolower($data['title']));
        $data['city_id'] = (int)$data['city_id'];
        $data['publisher_id'] = (int)$data['publisher_id'];
        $data['year'] = (int)$data['year'];
        $data['author_id'] = (int)$data['author_id'];
        $data['volume'] = isset($data['volume']) ? $data['volume'] : null;
        $result = $this->model->create($data);
        return $result;
    }
}
