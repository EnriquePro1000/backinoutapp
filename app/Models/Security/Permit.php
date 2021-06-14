<?php
namespace App\Models\Security;

use App\Models\Modelo;

class Permit extends Modelo
{
    protected $table = 'permits';
      
    protected $fillable = [
        "name",
        "created",
        "created_by",
        "updated",
        "updated_by",
        ];    
    
}
