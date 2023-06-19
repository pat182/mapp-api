<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Entities\Repositories\ProductRepository;
use Modules\Products\Http\Requests\{CreateProductRequest,UploadPhotoRequest};

class ProductsController extends Controller
{
    public function __construct(ProductRepository $product){

        $this->product = $product;

    }
    public function index(Request $req)
    {
        $req->validate( [ 'category' => 'required' ] );

        return response()->json([

            'data' =>$this->product->getProduct( $req->query(),$req->category)

        ],200);
        
    }
    public function create(CreateProductRequest $req)
    {

        return response()->json([
            'message' => 'Successfully Added A New Product',
            'data' => $this->product->createProduct($req->payload())
        ],200);

    }

    public function destroy($pid)
    {

        return response()->json($this->product->destroyProduct(decrypt($pid)),200); 

    }
    public function uploadPhoto(UploadPhotoRequest $req){
        
        return response()->json([
            "message" => "Successfully uploaded",
            "data" => $this->product->uploadProductPhotos($req)
        ],200);

    }
    // public function show($id)
    // {
        
    // }

    
    // public function edit($id)
    // {
    //     //
    // }

    
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    

}
