<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => $exception->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ProductOutOfStockException) {
            return response()->json(['message' => 'Product out of stock!'], JsonResponse::HTTP_CONFLICT);
        }

        if ($exception instanceof CartEmptyException) {
            return response()->json(['message' => 'Cart is empty!'], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        return parent::render($request, $exception);
    }
}
