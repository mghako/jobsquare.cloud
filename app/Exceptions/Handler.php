<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register() {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
        });

    }

    public function render($request, Throwable $exception) {
        if ($request->is('api/*')) {
            return $this->handleException($request, $exception);
        }
    
        return parent::render($request, $exception);

    }

  
    public function handleException($request, Exception $exception) {

        if ($exception instanceof MethodNotAllowedException) {
            return response()->json([
                'message' => 'The specified method for the request is invalid'
            ], 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'Not Found!'
            ], 404);
        }

        if ($exception instanceof HttpException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getStatusCode());
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);            
        }

        return response()->json([
            'message' => 'Unexpected Exception. Try later!'
        ], 500);

    }

}
