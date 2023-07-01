<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

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
                'file'=> $e->getFile(),
                'line'=> $e->getLine(),

            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
            
        }

    }
}
