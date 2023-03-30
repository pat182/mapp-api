<?php

namespace Modules\User\Services;

use App\Notifications\RegistrationNotification;
use Modules\User\Entities\Repositories\UserRepository;

class UserService
{

    
    public static function generateUserID() : string {
        $userId = bin2hex(random_bytes(16));

        if(UserRepository::getUser($userId)->first())

            return static::generateUserID();

        return $userId;


    }
    public static function sendEmailReg($user) : void
    {
        $user->notify(new RegistrationNotification());
        
    }
    
    public static function deleteDir($path) : void {

        if(\Storage::disk('local')->exists($path))

            \Storage::disk('local')->deleteDirectory($path);

    }
}
