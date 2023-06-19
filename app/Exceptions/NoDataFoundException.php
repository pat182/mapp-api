<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;


class NoDataFoundException extends BaseException
{
    public function message()
    {
        
        return 'No Data Found';
    
    }
    
    public function statusCode()
    {
        return 404;
    }

    
    public function errorCode()
    {
        return 'no-data';
        
    }
}