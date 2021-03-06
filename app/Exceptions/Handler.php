<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $exceptionClass = get_class($exception);

        if ($exceptionClass == "Tymon\JWTAuth\Exceptions\TokenExpiredException") {
            return response()->json(['error' => 'token_expired_no_refreshed'], $exception->getStatusCode());
        } else if ($exception instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['error' => 'token_invalid'], $exception->getStatusCode());
        } else if ($exceptionClass == "Tymon\JWTAuth\Exceptions\TokenBlacklistedException"){
            return response()->json(['error' => 'token_has_been_blacklisted'], $exception->getStatusCode());
        }  if ($exceptionClass == "Tymon\JWTAuth\Exceptions\JWTException"){
            return response()->json(['error' => 'token_absent'], $exception->getStatusCode());
        }else if ($exceptionClass == "Symfony\Component\HttpKernel\Exception\NotFoundHttpException"){
            return response()->view('errors.missing', [], 404);
        }
        /*else if ($exception instanceof \Illuminate\Validation\ValidationException){
            return response()->json(['errors' => $exception->errors()]);
        }*/

        return parent::render($request, $exception);
    }
}
