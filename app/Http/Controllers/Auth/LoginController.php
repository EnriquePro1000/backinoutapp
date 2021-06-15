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
                        'data' => [
                            'status' => "204",
                            'type' => "error",
                            'detail_en' => "The email does not exist",
                            'detail_es' => "El email no existe"
                        ]
            ]);
        }
        $credencials = $request->only("email", "password");
        if (!$token = auth($this->guard)->attempt($credencials)) {
            return response()->json([
                        'data' => [
                            'status' => "204",
                            'type' => "error",
                            'detail_en' => "Incorrect password",
                            'detail_es' => "Contraseña incorrecta"
                        ]
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
                    'data' => [
                        'status' => "200",
                        'token' => $token,
                        'user' => User::findOrFail(auth($this->guard)->id()),
                        'typeids' => TypeId::all(),
                        'areas' => Area::all(),
                        'countries' => Country::all(),
                        'users' => $this->userList(),
                    ]
        ]);
    }

    public function logout() {
        auth($this->guard)->logout();
        return response()->json([
                    'data' => [
                        'status' => "200",
                        'type' => "success",
                        'detail_en' => "Successfully loged out",
                        'detail_es' => "Deslogueado correctamente"
                    ]
        ]);
    }

    protected function RespondWithToken($token) {
        return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth($this->guard)->factory()->getTTL() //6 hrs
        ]);
    }

}
