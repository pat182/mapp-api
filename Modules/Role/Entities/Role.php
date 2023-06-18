<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // use HasFactory;
    protected $table = 'role';

    protected $fillable = ['permission'];
    
    protected $primaryKey = 'role_id';
    
    public $timestamps = false;
    
    
    
    // public function permissionGroup(){
    //     return $this->hasMany(PermissionGroupRepository::class,'permission_type_id','permission_type_id');
    // }
}