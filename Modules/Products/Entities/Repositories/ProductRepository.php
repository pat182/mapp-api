<?php

namespace Modules\Products\Entities\Repositories;

use App\Exceptions\ServerErrorException;
use Illuminate\Support\Facades\Auth;
use Modules\Products\Entities\Product;


class ProductRepository extends Product
{
	public function __construct(){


    }

    public function createProduct(array $payload){

        \DB::beginTransaction();
        try{
            
            $product = static::create($payload);
            \DB::commit();
            return $product;

        }catch(\Exception $e){

            \DB::rollback();
            throw (new ServerErrorException());
            
        }
        
    }
}