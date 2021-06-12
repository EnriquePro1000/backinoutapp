<?php
namespace App\Models\Security;

use App\Models\Modelo;

class AccessToken extends Modelo
{
    protected $table = 'access_token';
      
    protected $fillable = [
        "user_id",
        "token",
        "created_in",
        "expires_in",
        ];    
    
}
