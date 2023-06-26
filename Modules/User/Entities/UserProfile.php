<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\factories\UserProfileFactory;
use Modules\User\Entities\Repositories\UserRepository;

class UserProfile extends Model
{
    // use HasFactory;
    protected $table = 'user_profile';

    // protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'f_name',
        'l_name',
        // 'path'
    ];
    public $timestamps = false;
    
    public function userR(){
        return $this->hasOne(UserRepository::class,'user_id');
    }

    protected static function newF()
    {
        return UserProfileFactory::new();
    }
}
