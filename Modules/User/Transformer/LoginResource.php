<?php

namespace Modules\User\Transformer;

use Illuminate\Http\Resources\Json\JsonResource;


class LoginResource extends JsonResource
{
    
    public function toArray($request)
    {
        
        return [

            "user_id" => $this->resource['user']->user_id,
            "username" => $this->resource['user']->username,
            "token" => $this->resource['auth']['token'],
            "expires_in" => $this->resource['auth']['expires_in'],
            "expires_at" => $this->resource['auth']['expires_at']
        ];
    }
}
