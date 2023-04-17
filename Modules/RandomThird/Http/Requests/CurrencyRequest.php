<?php
namespace Modules\RandomThird\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest{
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
    public function rules(){
    	return  [
            'base_currency' => 'required|string|min:3|max:3',
            'currency' => 'nullable|string|max:3'
        ]; 
    }
   	public function payload()
    {
        return $this->only([
            "base_currency",
            "currency"
        ]);
    }
}