<?php
namespace App\Models\Security;

use App\Models\Modelo;

class TypeId extends Modelo
{
    protected $table = 'typeid';
      
    protected $fillable = [
        "abbrev",
        "name",
        "created",
        "created_by",
        "name",
        "updated",
        "updated_by",
        ];    
    
}
