<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => 'Not found',
                'data'    => [],
            ], 404);
        }

        if ($exception instanceof UnauthorizedException) {
            return $this->unauthorized($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * 沒有權限時的處理方式
     * @param           $request
     * @param Exception $exception
     * @return \Illuminate\Http\Response
     */
    private function unauthorized($request, UnauthorizedException $exception)
    {
        if ($request->expectsJson()) {
            $requiredPermissions = implode(', ', $exception->getRequiredPermissions());

            return response()->json([
                'success' => false,
                'message' => "{$exception->getMessage()} ({$requiredPermissions})",
                'data'    => [
                    'required' => $exception->getRequiredPermissions()
                ],
            ], 403);
        }

        abort(403);
    }
}
