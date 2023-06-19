<?php

namespace Modules\User\Entities\Repositories;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Filesystem\Filesystem;
use Modules\User\Services\UserService;
use Modules\Auth\Services\AuthService;
use Illuminate\Database\QueryException;
use App\Exceptions\ServerErrorException;

class UserRepository extends User
{
    
    public static function getUser($user_id){

        return static::where('user_id',$user_id);

    }
    public function createUser($req){

        $payload = $req->payload();
        DB::beginTransaction();
        $id = UserService::generateUserID();
        
        try{
            
            $user = self::create(array_merge($payload['user'], [

                'user_id' => $id,
                'password' => bcrypt($payload['user']['password'])

            ]));

            $payload['user_profile']['user_id'] = $id;
            // $payload['user_profile']['path'] = $req->file('image')->store("{$id}_images");

            $profile = UserProfileRepository::create($payload['user_profile']);

            UserService::sendEmail($user);

            $cred = [

                "username" => $payload['user']['username'],
                "password" => $payload['user']['password']

            ];

            DB::commit();
            
            //log in after creating
            // $auth = (new AuthService($user))->login($cred);
            // return $auth;
            
            return "User Succesfully Created";
            
            
           

        }catch(QueryException $q){
            
            DB::rollback();
            // UserService::deleteDir("{$id}_images");
            throw (new ServerErrorException);

        }catch(\Exception $e){
            
            DB::rollback();
            // UserService::deleteDir("{$id}_images");
            throw (new ServerErrorException);
            
        }
        
    }
    

}