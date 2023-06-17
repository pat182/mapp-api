<?php

namespace Modules\Auth\Transformer;

use Illuminate\Http\Resources\Json\JsonResource;


class LoginResource extends JsonResource
{
    
    public function toArray($request)
    {
       
        return [

            "user_id" => $this->resource['user_id'],
            "username" => $this->resource['username'],
            'email' => $this->resource['email'],
            'f_name' => $this->resource['f_name'],
            'l_name' => $this->resource['l_name'],
            // 'path' => $this->resource['path'],
            "token" => $this->resource['token'],
            "expires_in" => $this->resource['expires_in'],
            "expires_at" => $this->resource['expires_at']
        ];
    }
}
