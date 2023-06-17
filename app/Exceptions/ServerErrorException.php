<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;


class ServerErrorException extends BaseException
{
    public function message()
    {
        
        return 'Server Error';
    
    }
    
    public function statusCode()
    {
        return 500;
    }

    
    public function errorCode()
    {
        return '--';
        
    }
}