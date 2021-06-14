<?php
namespace App\Models\Security;

use App\Models\Modelo;

class Area extends Modelo
{
    protected $table = 'areas';
      
    protected $fillable = [
        "name",
        "created",
        "created_by",
        "updated",
        "updated_by",
        ];    
    
}
