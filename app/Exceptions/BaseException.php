<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseException extends Exception
{
    
    abstract public function errorCode();

    abstract public function statusCode();

    abstract public function message();

    public function render($request)
    {
        return response()->json([
            'code' => $this->statusCode(),
            'error_code' => $this->errorCode(),
            'message' => $this->message(),
        ], $this->statusCode());
    }

}
