<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Database\Factories\CategoryFactory;


class Categories extends Model
{

    protected $table = 'categories';
    
    protected $fillable = ['name','description','user'];

    protected static function newF()
    {
        return CategoryFactory::new();
    }
    
}

