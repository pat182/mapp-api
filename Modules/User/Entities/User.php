<?php

namespace Modules\User\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\User\Database\factories\UserFactory;
use Modules\User\Entities\Repositories\UserProfileRepository;
use Modules\Products\Entities\Repositories\CategoryRepository;
use Modules\Products\Entities\Repositories\ProductRepository;
use Modules\Role\Entities\Repositories\RoleRepository;

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
        'role',
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
    
    public function userProfile(){
        return $this->hasOne(UserProfileRepository::class,'user_id');
    }
    public function categories(){

        return $this->hasMany(CategoryRepository::class,'user');

    }
    public function products(){

        return $this->hasMany(ProductRepository::class,'user');

    }
    public function userRole(){

        return $this->hasOne(RoleRepository::class,'role_id','role');

    }

    
}
