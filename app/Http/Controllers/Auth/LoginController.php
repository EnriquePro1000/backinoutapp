<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use App\Models\Security\AccessToken;
use App\Models\Security\TypeId;
use App\Models\Security\Area;
use App\Models\Security\Country;
use Carbon\Carbon;

class LoginController extends Controller {

    public function login(Request $request) {
        if (User::where("email", $request->email)->count() == 0) {
            return response()->json([
                        'status' => "204",
                        'result' => "El email no existe"
            ]);
        }
        $credencials = $request->only("email", "password");
        if (!$token = auth($this->guard)->attempt($credencials)) {
            return response()->json([
                        'status' => "204",
                        'result' => "Password incorrecta"
            ]);
        }
        $apiToken["user_id"] = auth($this->guard)->id();
        $apiToken["token"] = $token;
        $apiToken["created_in"] = Carbon::now();
        $apiToken["expires_in"] = Carbon::now()->addHours(6);

        if (AccessToken::where("user_id", auth($this->guard)->id())->count() == 0) {
            AccessToken::create($apiToken);
        } else {
            $TokeninDB = AccessToken::where("user_id", auth($this->guard)->id());
            $TokeninDB->update($apiToken);
        }

        return response()->json([
                    'status' => "200",
                    'token' => $token,
                    'user'   => User::findOrFail(auth($this->guard)->id()),
                    'typeids'=> TypeId::all(),
                    'areas'=> Area::all(),
                    'countries'=> Country::all(),
                    'users'=> User::select('users.*', 'countries.name as country_name','typeid.abbrev as typeid_abbrev')
                              ->join('countries', 'countries.id', '=', 'users.country_id')
                              ->join('typeid', 'typeid.id', '=', 'users.typeid_id')
                              ->where("users.id","!=",auth($this->guard)->id())
                              ->get()
                ]);
    }

    public function logout() {
        auth($this->guard)->logout();
        return response()->json([
                    'status' => "200",
                    'result' => 'Successfully loged out'
        ]);
    }

    protected function RespondWithToken($token) {
        return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth($this->guard)->factory()->getTTL() * 2160 //6 hrs
        ]);
    }
}
