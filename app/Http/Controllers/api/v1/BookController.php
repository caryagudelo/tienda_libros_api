<?php
namespace App\Http\Controllers\api\v1;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Request\BookRequest;
use Illuminate\support\Facades\Log;
use App\Http\Requests\saveBookRequest;

class BookController extends Controller

{
    public function index()
    {
        
            $books = Book::all();

            return response()->json(['success' => true, 'data' => $books]);
        }
    public function show($id)
    {
        $book = Book::find($id);

       return $this->checkModelExists(function () use ($book) {
        return response()->json(['success'=> true, 'data' => $book]);
 }, $book,  trans('messages.book.not_found'));
    }
    public function store(saveBookRequest  $request)
    {
        $book = Book::create($request->all());
        return response()->json(['success' => true, 'message' => trans('messages.book.created'), 'data' => $book]);

    }
    public function update(saveBookRequest $request, $id)
    {
        $book = Book::find($id);
         return $this->checkModelExists(function () use ($book, $request) {
                $book->update($request->all());
 
   return response()->json(['success' => true, 'message' => trans('messages.book.updated'), 'data' => $book]);
}, $book, trans('messages.book.not_found'));
        }
    public function destroy($id)
    {
        $book = Book::find($id);
        return $this->checkModelExists(function () use ($book){
            $book->delete();
        
        $book->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
        }, $book, trans('messages.book.not_found'));
    }
}
