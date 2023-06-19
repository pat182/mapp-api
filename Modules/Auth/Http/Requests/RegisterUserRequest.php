<?php
namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest{
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
    public function rules(){
        
    	return  [

            'user.username' => 'required|string|between:1,45|unique:user',
            'user.email' => 'required|string|email|max:255|unique:user',
            'user.password' => 'required|string|min:8',
            'user_profile.f_name' => 'nullable|regex:/^[a-z0-9 .\-,]+$/i',
            'user_profile.l_name' => 'nullable|regex:/^[a-z0-9 .\-,]+$/i',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
            
        ]; 
    }
   	public function payload()
    {
        return $this->only([
            
            "user.role",
            "user.username",
            "user.email",
            "user.password",
            "user_profile.f_name",
            "user_profile.l_name",

        ]);
    }
}