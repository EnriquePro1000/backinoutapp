<?php

namespace App\Models\Security;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject {   //install tymon: composer require tymon/jwt-auth:dev-develop --prefer-source

    use HasFactory,
        Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'area_id',
        'typeid_id',
        'role_id',
        'numberid',
        'firstname',
        'othername',
        'flastname',
        'slastname',
        'email',
        'active',
        'created',
        'created_by',
        'updated',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTCustomClaims(): array {
        return [];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    
    public function country(){
        $this->hasOne("App\Models\Security\Country", "id", "country_id");
    }

}
