<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    
    public function index()
    {
        
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        return view('products::show');
    }

    
    public function edit($id)
    {
        return view('products::edit');
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
