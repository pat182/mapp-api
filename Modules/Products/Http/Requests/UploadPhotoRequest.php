<?php
namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends FormRequest{

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
            'product' => 'required|string',
            // 'description' => 'nullable|string',
            'photos*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'

        ]; 
    }
   	public function payload()
    {

        return $this->only([
            'product',
            'description',
            'photos'
        ]);

    }
}