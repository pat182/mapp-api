<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;


class BadRequestException extends BaseException
{
    public function message()
    {
        
        return 'Bad Request Exception';
    
    }
    
    public function statusCode()
    {
        return 422;
    }

    
    public function errorCode()
    {
        return 'bad-request';
        
    }
}