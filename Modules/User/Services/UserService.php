<?php

namespace Modules\User\Services;

use Modules\User\Entities\Repositories\UserRepository;
use Modules\Auth\Notifications\RegistrationNotification;


class UserService
{

    
    public static function generateUserID() : string {

        $userId = bin2hex(random_bytes(16));

        if(UserRepository::getUser($userId)->first())

            return static::generateUserID();

        return $userId;


    }
    public static function sendEmail($user,string $emailType='') : void
    {
        if(!$emailType)

            $user->notify( new RegistrationNotification() );

        
        
        
    }
    
    public static function deleteDir($path) : void {

        if(\Storage::disk('local')->exists($path))

            \Storage::disk('local')->deleteDirectory($path);

    }
}
