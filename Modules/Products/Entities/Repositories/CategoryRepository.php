<?php

namespace Modules\Products\Entities\Repositories;

use App\Exceptions\ServerErrorException;
use Illuminate\Support\Facades\Auth;
use Modules\Products\Entities\Categories;
use App\Exceptions\NoDataFoundException;


class CategoryRepository extends Categories
{
	// public function __construct(){


 //    }
    
    public function getCategories(array $params){
        
        $page = isset($params['page']) ? $params['page'] : 1;
        $sort = isset($params['sort']) ? $params['sort'] : 'DESC';
        $order = isset($params['order']) ? $params['order'] : 'created_at';
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;

        $category = static::when(isset($params['name']), function($q) use ($params){

            return $q->where( 'name', 'LIKE',  '%' . $params['name'] . '%' );

        })->when(isset($params['description']), function($q) use ($params){

            return $q->where( 'description', 'LIKE',  '%' . $params['description'] . '%' );

        })
        ->where('user',Auth::id())
        ->orderBy($order,$sort)->paginate($perPage);

        if( empty($category->toArray()['data']) )

            throw new NoDataFoundException();


        return $category;

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