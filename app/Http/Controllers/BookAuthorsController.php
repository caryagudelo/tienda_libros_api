<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\BookAuthor;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class BookAuthorController extends Controller
{
    public function index()
    {
        $bookAuthors = BookAuthor::all();

        return response()->json(['success' => true, 'data' => $bookAuthors]);
    }

    public function show($id)
    {
        $bookAuthor = BookAuthor::find($id);

        return $this->checkModelExists(function () use ($bookAuthor) {
            return response()->json(['success' => true, 'data' => $bookAuthor]);
        }, $bookAuthor, trans('messages.book_author.not_found'));
    }

    public function store(Request $request)
    {
        $bookAuthor = BookAuthor::create($request->all());

        return response()->json(['success' => true, 'message' => trans('messages.book_author.created'), 'data' => $bookAuthor], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $bookAuthor = BookAuthor::find($id);

        return $this->checkModelExists(function () use ($bookAuthor, $request) {
            $bookAuthor->update($request->all());

            return response()->json(['success' => true, 'message' => trans('messages.book_author.updated'), 'data' => $bookAuthor], Response::HTTP_CREATED);
        }, $bookAuthor, trans('messages.book_author.not_found'));
    }

    public function destroy($id)
    {
        $bookAuthor = BookAuthor::find($id);

        return $this->checkModelExists(function () use ($bookAuthor){
            $bookAuthor->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        }, $bookAuthor, trans('messages.book_author.not_found'));
    }
}