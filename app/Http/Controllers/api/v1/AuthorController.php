<?php
namespace App\Http\Controllers\api\v1;


use App\Http\Requests\SaveAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\support\Facades\Log;


class AuthorController extends Controller

{
    public function index()
    {
        
            $author = Author::all();

            return response()->json(['success' => true, 'data' => $author]);
        }
    public function show($id)
    {
        $author = author::find($id);

       return $this->checkModelExists(function () use ($author) {
        return response()->json(['success'=> true, 'data' => $author]);
 }, $author,  trans('messages.author.not_found'));
    }
    public function store(SaveAuthorRequest  $request)
    {
        $author = Author::create($request->all());
        return response()->json(['success' => true, 'message' => trans('messages.author.created'), 'data' => $author]);

    }
    public function update(SaveAuthorRequest $request, $id)
    {
        $author = Author::find($id);
         return $this->checkModelExists(function () use ($author, $request) {
                $author->update($request->all());
 
   return response()->json(['success' => true, 'message' => trans('messages.author.updated'), 'data' => $author]);
}, $author, trans('messages.author.not_found'));
        }
    public function destroy($id)
    {
        $author= Author::find($id);
        return $this->checkModelExists(function () use ($author){
            $author->delete();
        
        $author->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
        }, $author, trans('messages.author.not_found'));
    }
}

