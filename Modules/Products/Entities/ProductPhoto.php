<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Database\Factories\ProductFactory;
use Modules\Products\Entities\Repositories\ProductRepository;

class ProductPhoto extends Model
{

    protected $table = 'product_photos';
    
    protected $fillable = ['product','description','path'];
    
    public function product(){

        return $this->belongsTo(ProductRepository::class,'product');

    }
}