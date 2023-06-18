<?php

namespace Modules\User\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Entities\Repositories\UserProfileRepository;


class User extends Authenticatable implements JWTSubject
{
    // use HasFactory;
    use Notifiable;
    // ,HasFactory;

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    public $incrementing = false;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'password',
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password'
    ];
    public function userProfile(){
        return $this->hasOne(UserProfileRepository::class,'user_id');
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected static function newF()
    {
        return UserFactory::new();
    }

    
}
