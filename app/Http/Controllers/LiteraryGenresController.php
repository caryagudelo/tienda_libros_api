<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\LiteraryGenre;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class LiteraryGenreController extends Controller
{
    public function index()
    {
        $literaryGenres = LiteraryGenre::all();

        return response()->json(['success' => true, 'data' => $literaryGenres]);
    }

    public function show($id)
    {
        $literaryGenre = LiteraryGenre::find($id);

        return $this->checkModelExists(function () use ($literaryGenre) {
            return response()->json(['success' => true, 'data' => $literaryGenre]);
        }, $literaryGenre, trans('messages.literary_genre.not_found'));
    }

    public function store(Request $request)
    {
        $literaryGenre = LiteraryGenre::create($request->all());

        return response()->json(['success' => true, 'message' => trans('messages.literary_genre.created'), 'data' => $literaryGenre], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $literaryGenre = LiteraryGenre::find($id);

        return $this->checkModelExists(function () use ($literaryGenre, $request) {
            $literaryGenre->update($request->all());

            return response()->json(['success' => true, 'message' => trans('messages.literary_genre.updated'), 'data' => $literaryGenre], Response::HTTP_CREATED);
        }, $literaryGenre, trans('messages.literary_genre.not_found'));
    }

    public function destroy($id)
    {
        $literaryGenre = LiteraryGenre::find($id);

        return $this->checkModelExists(function () use ($literaryGenre){
            $literaryGenre->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        }, $literaryGenre, trans('messages.literary_genre.not_found'));
    }
}