<?php
namespace App\Models\Security;

use App\Models\Modelo;

class Role extends Modelo
{
    protected $table = 'roles';
      
    protected $fillable = [
        "name",
        "created",
        "created_by",
        "updated",
        "updated_by",
        ];    
    
}
