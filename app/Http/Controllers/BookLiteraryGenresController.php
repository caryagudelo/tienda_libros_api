<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\BookLiteraryGenre;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class BookLiteraryGenreController extends Controller
{
    public function index()
    {
        $bookLiteraryGenres = BookLiteraryGenre::all();

        return response()->json(['success' => true, 'data' => $bookLiteraryGenres]);
    }

    public function show($id)
    {
        $bookLiteraryGenre = BookLiteraryGenre::find($id);

        return $this->checkModelExists(function () use ($bookLiteraryGenre) {
            return response()->json(['success' => true, 'data' => $bookLiteraryGenre]);
        }, $bookLiteraryGenre, trans('messages.book_literary_genre.not_found'));
    }

    public function store(Request $request)
    {
        $bookLiteraryGenre = BookLiteraryGenre::create($request->all());

        return response()->json(['success' => true, 'message' => trans('messages.book_literary_genre.created'), 'data' => $bookLiteraryGenre], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $bookLiteraryGenre = BookLiteraryGenre::find($id);

        return $this->checkModelExists(function () use ($bookLiteraryGenre, $request) {
            $bookLiteraryGenre->update($request->all());

            return response()->json(['success' => true, 'message' => trans('messages.book_literary_genre.updated'), 'data' => $bookLiteraryGenre], Response::HTTP_CREATED);
        }, $bookLiteraryGenre, trans('messages.book_literary_genre.not_found'));
    }

    public function destroy($id)
    {
        $bookLiteraryGenre = BookLiteraryGenre::find($id);

        return $this->checkModelExists(function () use ($bookLiteraryGenre){
            $bookLiteraryGenre->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        }, $bookLiteraryGenre, trans('messages.book_literary_genre.not_found'));
    }
}