<?php
namespace App\Helpers;


class ExceptionHelper{
    static function handle($e){
        $statusCode = 500; // Default status code for server errors
        $message = $e->getMessage();

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $statusCode = 404;
            $message = $e->getMessage();
        } elseif ($e instanceof \Illuminate\Validation\ValidationException) {
            $statusCode = 422;
            $message = $e->getMessage();
        } elseif ($e instanceof \Illuminate\Database\QueryException) {
            $statusCode = 409;
            $message = $e->getMessage();
        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            $statusCode = 405;
            $message = $e->getMessage();
        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
            $statusCode = 401;
            $message = $e->getMessage();
        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException) {
            $statusCode = 429;
            $message = $e->getMessage();
        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            $statusCode = $e->getStatusCode();
        }
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
        ], $statusCode);
    }
}