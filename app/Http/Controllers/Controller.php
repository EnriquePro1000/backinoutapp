<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Security\Country;
use App\Models\Security\User;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function __construct() {
        header('Access-Controll-Allow-Origin', "*");
        header('Access-Controll-Allow-Methods', "PUT,POST,DELETE,GET,OPTIONS");
        header('Access-Controll-Allow-Headers', "Accept,Authorization,Content-Type");
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
    }

    public function createEmail($request) {
        $fn = str_replace(" ", "", $request->firstname);
        $fl = str_replace(" ", "", $request->flastname);
        $ct = Country::findOrFail($request->countryid);
        $email = strtolower(trim($fn)) . "." . strtolower(trim($fl));
        $count = User::where("email", "LIKE", '%' . $email . '%')->count();

        if ($count == 0) {
            $email = strtolower($fn) . "." . strtolower($fl) . "@cidenet.com." . $ct["abbrev"];
            return $email;
        }
        
        $email = strtolower($fn) . "." . strtolower($fl) . "." . ($count + 1) . "@cidenet.com.";
        $exist = User::where("email", "LIKE", '%' . $email . '%')->count();

        while ($exist != 0) {
            $email = strtolower($fn) . "." . strtolower($fl) . "." . ($count) . "@cidenet.com.";
            $exist = User::where("email", "LIKE", '%' . $email . '%')->count();
            $count++;
        }
        return $email . $ct["abbrev"];
    }
    
    public function userList() {
        return User::select('users.*', 'countries.name as country_name', 'areas.name as area_name','typeid.abbrev as typeid_abbrev')
                        ->join('countries', 'countries.id', '=', 'users.country_id')
                        ->join('areas', 'areas.id', '=', 'users.area_id')
                        ->join('typeid', 'typeid.id', '=', 'users.typeid_id')
                        ->where("users.id", "!=", auth($this->guard)->id())
                        ->get();
    }
}
