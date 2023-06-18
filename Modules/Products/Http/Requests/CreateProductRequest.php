<?php
namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
    public function rules(){
        
    	return  [
            // 'name' => 'required|string|between:1,255|unique:categories,name',
            'category' => 'required|exists:categories,id',
            'name' => 'required|string|between:1,255',
            'description' => 'nullable|string'
        ]; 
    }
   	public function payload()
    {

        return $this->only([

            'category',
            'name',
            'description'

        ]);

    }
}