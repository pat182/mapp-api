<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Http\Requests\CreateProductRequest;
use Modules\Products\Entities\Repositories\ProductRepository;

class ProductsController extends Controller
{
    public function __construct(ProductRepository $product){

        $this->product = $product;

    }
    public function index()
    {
        
    }
    public function create(CreateProductRequest $req)
    {
        return response()->json([
            'message' => 'Successfully Added A New Product',
            'data' => $this->product->createProduct($req->payload())
        ],200);
    }
    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
