<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    protected $pagination = 20;

    protected function respondCreated($message, $fields = [])
    {
        $array = array_merge($fields, ['error' => false, 'message' => $message]);

        return response()->json($array, 201);
    }

    protected function respondOK($message, $fields = [])
    {
        $array = array_merge($fields, ['error' => false, 'message' => $message]);

        return response()->json($array, 200);
    }

    protected function respondBadRequest($message)
    {
        return response()->json(['error' => true, 'message' => $message], 400);
    }

    protected function respondNotFound($message)
    {
        return response()->json(['error' => true, 'message' => $message], 404);
    }
    protected function respondUnauthorized($message)
    {
        return response()->json(['error' => true, 'message' => $message], 403);
    }

    protected function createPaginator($request, $data, $page)
    {
        $data = $data->values()->all();
//        return $data;
        return new LengthAwarePaginator(array_slice($data, ($page * $this->pagination) - $this->pagination, $this->pagination, false), count($data), $this->pagination, $page, ['path' => $request->url()]);
    }
}
