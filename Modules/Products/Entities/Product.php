<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Database\Factories\ProductFactory;
use Modules\Products\Entities\Repositories\CategoryRepository;
use Modules\User\Entities\Repositories\UserRepository;
use Modules\Products\Entities\ProductPhoto;

class Product extends Model
{

    protected $table = 'products';
    
    protected $fillable = ['category','name','description','user'];

    protected $appends = ['encId'];

    protected static function newF()
    {
        return ProductFactory::new();
    }
    public function getEncIdAttribute()
    {
        return $this->attributes['encId'] = encrypt($this->id);  
    }
    public function user(){

        return $this->belongsTo(UserRepository::class,'user');

    }
    public function category(){

        return $this->belongsTo(CategoryRepository::class,'category');

    }
    public function productPhoto(){

        return $this->hasMany(ProductPhoto::class,'product');

    }
}