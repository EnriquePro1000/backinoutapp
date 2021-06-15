<?php

namespace App\Http\Controllers\Security;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use Carbon\Carbon;

class CreateUserController extends Controller {

    public function createUser(Request $request) {
        Log::debug("Method 'createUser' initialited");
        $RegisterDate = Carbon::createFromFormat('Y-m-d', $request->registerdate);
        if ($RegisterDate < Carbon::now()->subDays(30) | $RegisterDate > Carbon::now()) {            
            Log::debug("Method 'createUser' fail: The registration date cannot be earlier than 30 days or greater than today");
            return response()->json([
                        'data' => [
                            'status' => "204",
                            'type' => "error",
                            'detail_en' => "The registration date cannot be earlier than 30 days or greater than today",
                            'detail_es' => "La fecha del registro no puede ser anterior a 30 días o superior a hoy"
                        ]
            ]);
        }

        if (User::where("numberid", trim($request->numberid))->count() > 0) {
            Log::debug("Method 'createUser' fail: The numberId has been taken");
            return response()->json([
                        'data' => [
                            'status' => "422",
                            'type' => "Unprocessabble entity",
                            'detail_en' => "The numberId has been taken",
                            'detail_es' => "La identificación fue usada anteriormente"
                        ]
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
            Log::debug("Method 'createUser' finish successfully");
            return response()->json([
                        'data' => [
                            'status' => "200",
                            'type' => "success",
                            'detail_en' => "The user was created correctly",
                            'detail_es' => "El usuario fue creado correctamente"
                        ]
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            throw $e;
        }
    }

}
