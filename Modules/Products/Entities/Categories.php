<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Database\Factories\CategoryFactory;
use Modules\Products\Entities\Repositories\ProductRepository;
use Modules\User\Entities\Repositories\UserRepository;

class Categories extends Model
{

    protected $table = 'categories';
    
    protected $fillable = ['name','description','user'];

    protected static function newF()
    {
        return CategoryFactory::new();
    }

    public function user(){

        return $this->belongsTo(UserRepository::class,'user');

    }
    public function products(){

        return $this->hasMany(ProductRepository::class,'category');

    }
    
}

