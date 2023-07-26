<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

public function render($request, Throwable $e)
{
 if ($e instanceof \Exception){
    Log::error($e->getMessage() . 'line: ' . $e->getline() . ' file: ' .
    $e->getFile());

return response()->json([
    'success' => false,
    'message' => trans('messages.global_errors.internal_server_error'),
    'info' => [
        'info_error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),

    ]
], Response::HTTP_INTERNAL_SERVER_ERROR);
}
return parent::render($request, $e);
}
}
















