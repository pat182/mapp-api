<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    protected $table = 'categories';
    
    protected $fillable = ['name','description','user'];
    
}

