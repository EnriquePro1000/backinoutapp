<?php
namespace App\Models\Security;

use App\Models\Modelo;

class Country extends Modelo
{
    protected $table = 'countries';
      
    protected $fillable = [
        "abbrev",
        "name",
        "created",
        "created_by",
        "updated",
        "updated_by",
        ];    
    
}
