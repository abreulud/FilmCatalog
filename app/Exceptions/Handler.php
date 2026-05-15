<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];
    protected $dontFlash  = ['password', 'password_confirmation'];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        // Erros JWT
        if ($exception instanceof UnauthorizedHttpException) {
            $previous = $exception->getPrevious();

            if ($previous instanceof TokenExpiredException) {
                return response()->json(['message' => 'Token expirado. Faça login novamente.'], 401);
            }

            if ($previous instanceof TokenInvalidException) {
                return response()->json(['message' => 'Token inválido.'], 401);
            }

            return response()->json(['message' => 'Token não fornecido.'], 401);
        }

        return parent::render($request, $exception);
    }
}