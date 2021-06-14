<?php

namespace App\Models\Security;

use App\Models\Modelo;

class PermitRole extends Modelo {

    protected $table = 'permit_role';
    protected $fillable = [
        "permit_id",
        "role_id",
        "created",
        "created_by",
        "updated",
        "updated_by",
    ];

}
