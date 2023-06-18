<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Database\Factories\ProductFactory;


class Product extends Model
{

    protected $table = 'products';
    
    protected $fillable = ['category','name','description'];

    protected static function newF()
    {
        return ProductFactory::new();
    }
    
}