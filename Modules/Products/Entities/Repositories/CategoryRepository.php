<?php

namespace Modules\Products\Entities\Repositories;

use App\Exceptions\ServerErrorException;
use Illuminate\Support\Facades\Auth;
use Modules\Products\Entities\Categories;


class CategoryRepository extends Categories
{
	public function __construct(){


    }

    public function createCategory(array $payload){

        $payload = array_merge($payload,['user'=> Auth::id()]);
        \DB::beginTransaction();
        try{
            
            $category = static::create($payload);
            \DB::commit();
            return $category;

        }catch(\Exception $e){

            \DB::rollback();
            throw (new ServerErrorException());
            
        }
        
    }
}