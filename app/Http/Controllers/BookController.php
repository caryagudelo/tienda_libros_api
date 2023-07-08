<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Log;
use App\Http\Request\BookRequest;

class BookController extends Controller

{
    public function index()
    {
        try {
            $books = Book::all();

            return response()->json(['success' => true, 'data' => $books]);
        } catch (exception $e) {
            log::error($e->getMessage() . 'line: ' . $e->getline() . ' file: ' .
                $e->getFile());

            return response()->json([
                'success' => false,
                'message' => 'error de servidor',
                'info' => [
                    'info_error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),

                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

    }

    public function show($id)
    {
        $book = Book::find($id);

        if (empty($book)) {
            return response()->json([
                'success' => false,
                'message' => 'El libro no
        existe.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['success' => true, 'data' => $book]);
    }

    public function store(saveBookRequest  $request)
    {
        $book = Book::create($request->all());
        return response()->json(['success' => true, 'message' => 'Libro creado con exito', 'data' => $book]);
    }
    public function update(saveBookRequest $request, $id)
    {
        $book = Book::find($id);


        if (empty($book)) {
            return response()->json([
                'success' => false,
                'message' => 'El libro no
existe.'
            ], Response::HTTP_NOT_FOUND);


            $book->update($request->all());

            return response()->json(['success' => true, 'message' => 'libro actualizado con exito.', 'data' => $book]);
        }

    }
    public function destroy($id)
    {
        $book = Book::find($id);
        if (empty($book)) {
            return response()->json([
                'success' => false,
                'message' => 'El libro no
existe.'
            ], Response::HTTP_NOT_FOUND);

        
        $book->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
}