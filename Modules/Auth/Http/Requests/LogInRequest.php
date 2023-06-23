<?php
namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogInRequest extends FormRequest{
    

    public function rules(){
        
        return static::checkIfAdmin(); 
    }
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
   	public function payload()
    {
        $arr = $this->role_id == 1 ? [
            "role",
            "username",
            "password",
            'remember_me'

        ] : [
                "role",
                "username",
                "password",
                'remember_me'
            ];
        return $this->only($arr);
    }

    private function checkIfAdmin() : array {
        $arr = [

            "role" => "required|exists:role,role_id|exists:user,role",
            'password' => 'required',
            'remember_me' => 'boolean|nullable'
        ];
        if($this->role_id == 1){

            return array_merge([

                'email' => 'required_without:username|string',
                'username' =>'required_without:email|string',
                
            ], $arr);


        }else{

            return array_merge([

                'username' => 'required',
                
            ],$arr); 

        }

    }
    
}