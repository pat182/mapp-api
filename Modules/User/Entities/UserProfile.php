<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'path'
    ];
    public $timestamps = false;
    
    public function userR(){
        return $this->belongsTo(UserRepository::class);
    }
    // protected static function newFactory()
    // {
    //     return \Modules\User\Database\factories\UserProfileFactory::new();
    // }
}
