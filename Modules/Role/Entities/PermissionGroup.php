<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Role\Entities\Repositories\RoleRepository;


class Permissiongroup extends Model
{
    // use HasFactory;
    protected $table = 'permission_group';

    protected $fillable = [ 'role_id','permission_id' ];
    
    protected $primaryKey = 'role_id';
    
    public $timestamps = false;
    
    
    
    public function role(){
        return $this->belongsTo(RoleRepository::class,'role_id');
    }
}