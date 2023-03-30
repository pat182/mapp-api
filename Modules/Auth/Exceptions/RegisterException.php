<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\BaseException;


class RegisterException extends BaseException
{
    public function message()
    {
        
        return "Something went wrong";
    
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
