<?php
namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogInRequest extends FormRequest{
    

    public function rules(){
        
        return [
            'email' => 'required_without:username|string|email',
            'username' =>'required_without:email|string',
            'password' => 'required',
            'remember_me' => 'boolean|nullable'
        ];

    }
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
   	public function payload()
    {
        return $this->only([
            "username",
            "password",
            'remember_me'
        ]);
    }
    
}