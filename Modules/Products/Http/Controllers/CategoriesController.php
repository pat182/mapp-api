<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Http\Requests\CreateCategoryRequest;
use Modules\Products\Entities\Repositories\CategoryRepository;


class CategoriesController extends Controller
{
    
    public function __construct(CategoryRepository $category){

        $this->category = $category;

    }

    public function getAll(){

        return response()->json([
            'data' => $this->category->all()
        ],200);

    }

    public function index(Request $req)
    {

        return response()->json([

            'data' => $this->category->getCategories( $req->query())

        ],200);
    }

    
    public function create(CreateCategoryRequest $req)
    {   
        
        return response()->json([
            'message' => 'Successfully Created A New Category',
            'data' => $this->category->createCategory($req->payload())
        ],200);
    }

    
    public function store(Request $request)
    {
        
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        
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
