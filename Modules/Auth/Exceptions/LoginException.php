<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\BaseException;


class LoginException extends BaseException
{
    public function message()
    {
        
        return 'Invalid Credentials';
    
    }
    
    public function statusCode()
    {
        return 400;
    }

    
    public function errorCode()
    {
        return '--';
        
    }
}