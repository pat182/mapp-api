<?php

namespace Modules\Products\Entities\Repositories;

use App\Exceptions\ServerErrorException;
use Illuminate\Support\Facades\Auth;
use Modules\Products\Entities\Product;
use App\Exceptions\NoDataFoundException;
use Modules\Products\Entities\Repositories\ProductPhotoRepository;


class ProductRepository extends Product
{
	public function __construct(){

        

    }

    public function getProduct(array $params,$catId){
        
        $page = isset($params['page']) ? $params['page'] : 1;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sort = isset($params['sort']) ? $params['sort'] : 'desc';
        $order = isset($params['order']) ? $params['order'] : 'created_at';

        $products = static::whereHas('category', function($q){
            $q->where('user',Auth::id());
        })
        ->with('productPhoto')
        ->when(isset($params['name']), function($q) use ($params){

            return $q->where( 'name', 'LIKE',  '%' . $params['name'] . '%' );

        })->when(isset($params['description']), function($q) use ($params){

            return $q->where( 'description', 'LIKE',  '%' . $params['description'] . '%' );

        })->where('category', $catId)
        ->paginate($perPage);

        if( empty($products->toArray()['data']) )

            throw new NoDataFoundException();


        return $products;

        
    }
    public function createProduct(array $payload) : static {

        \DB::beginTransaction();
        try{
            $payload['user'] = Auth::id();
            $product = static::create($payload);
            \DB::commit();
            return $product;

        }catch(\Exception $e){
            dd($e);
            \DB::rollback();
            throw (new ServerErrorException());
            
        }
        
    }
    public function destroyProduct(string $id) : array {

        $product = static::with('productPhoto')->find($id);
            
        if(!$product)

            throw new NoDataFoundException();

        
        (new ProductPhotoRepository())->deletePhoto($product);

        $product->delete();

        return [

            'message' => "{$product->name} Successfully deleted",
            'data' => $product

        ];

    }
    public function uploadProductPhotos($req) {

        $payload = $req->payload();
        $payload['product'] = decrypt($payload['product']);
        $photo = (new ProductPhotoRepository())->uploadPhoto($payload);
        return $photo;

    }

    public function setProductPhoto($prodId,$id) : array{
        $pp = (new ProductPhotoRepository());

        
        $unset = $pp->where('is_primary' , 1)
        ->where('product', $prodId)->update([
            "is_primary" => 0
        ]);

        $set = tap($pp->where('id',decrypt($id)))
        ->update([

            'is_primary' => 1

        ])->first();

        return [
            "message" => explode('/', $set->path)[1] . " Succesfully Set",
            "data" => $set
        ];        

    }
}