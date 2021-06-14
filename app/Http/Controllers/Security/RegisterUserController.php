<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use Carbon\Carbon;

class RegisterUserController extends Controller {

    public function create(Request $request) {
        $RegisterDate = Carbon::createFromFormat('Y-m-d', $request->registerdate);
        if ($RegisterDate < Carbon::now()->subDays(30) | $RegisterDate > Carbon::now()) {
            return response()->json([
                        'status' => "204",
                        'result' => "La fecha del registro no puede ser anterior a 30 días o superior a hoy"
            ]);
        }

        if (User::where("numberid", trim($request->numberid))->count() > 0) {
            return response()->json([
                        'status' => "204",
                        'result' => "Ya existe un usuario con esta identificación"
            ]);
        }

        $user["country_id"] = $request->countryid;
        $user["area_id"] = $request->areaid;
        $user["role_id"] = 2; //user is predeterminated
        $user["typeid_id"] = $request->typeid;
        $user["numberid"] = trim($request->numberid);
        //$request->firstname = str_replace(" ","",$request->firstname);
        $user["firstname"] = trim(strtoupper($request->firstname));
        if ($request->othername != null) {
            $user["othername"] = trim(strtoupper($request->othername));
        }
        $user["flastname"] = trim(strtoupper($request->flastname));
        $user["email"] = $this->createEmail($request);
        $user["slastname"] = trim(strtoupper($request->slastname));
        $user["active"] = true; //user is active predeterminated
        $user["created"] = $request->registerdate;
        $user["created_by"] = auth($this->guard)->id();

        \DB::beginTransaction();
        try {
            User::create($user);
            \DB::commit();
             return response()->json([
                    'status' => "200",
                    'result' => "El usuario fue registrado correctamente"
        ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            throw $e;
        }       
    }
}
