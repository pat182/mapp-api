<?php

namespace Modules\Products\Entities\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\ServerErrorException;
use Modules\Products\Entities\ProductPhoto;
// use Modules\Products\Entities\Repositories\ProductRepository;

class ProductPhotoRepository extends ProductPhoto
{

	public function __construct(){


    }
    public function uploadPhoto(array $photo) : array {
        $user = Auth::user();
        $path = "{$user->user_id}_product_photos/";
        $data = [];
        try{
            foreach($photo['photos'] as $photoDetails){
                
                if(Storage::has($path) ){
                    
                    Storage::put(
                        $path.$photoDetails['photo']->getClientOriginalName(),
                        file_get_contents($photoDetails['photo'])
                    );

                }else{

                    $photoDetails['photo']->storeAs(
                        $path,
                        $photoDetails['photo']->getClientOriginalName()
                    );

                }
                array_push($data, static::updateOrCreate([

                        'path' => $path.$photoDetails['photo']->getClientOriginalName()

                     ],[
                    'product' => $photo['product'],
                    'path' => $path.$photoDetails['photo']->getClientOriginalName(),
                    'description' => isset($photoDetails['description']) ? $photoDetails['description'] : ''
                ])->toArray());
                

            }
            return $data; 
        }catch(\Exception $e){

            throw (new ServerErrorException());

        }

    }

    public function deletePhoto($product) : void {


        $user = Auth::user();
        $product->productPhoto()->delete();
        if(Storage::has("{$user->user_id}_product_photos/"))

                Storage::deleteDirectory("{$user->user_id}_product_photos");
        

    }
    
}