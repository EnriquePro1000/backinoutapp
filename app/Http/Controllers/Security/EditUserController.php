<?php

namespace App\Http\Controllers\Security;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use App\Models\Security\Country;
use Carbon\Carbon;

class EditUserController extends Controller {

    public function editUser(Request $request, $id) {
        Log::debug("Method 'editUser' initialited");
        $user = User::findOrFail($id);
        if ($request->numberid != $user["numberid"] &&
                User::where("numberid", trim($request->numberid))->count() > 0) {
            Log::debug("Method 'editUser' fail: The numberId has been taken");
            return response()->json([
                        'data' => [
                            'status' => "422",
                            'type' => "Unprocessabble entity",
                            'detail_en' => "The numberId has been taken",
                            'detail_es' => "La identificación fue usada anteriormente"
                        ]
            ]);
        }

        $upd["country_id"] = $request->countryid;
        $upd["area_id"] = $request->areaid;
        $upd["typeid_id"] = $request->typeid;
        $upd["numberid"] = trim($request->numberid);
        //$request->firstname = str_replace(" ","",$request->firstname);
        $upd["firstname"] = trim(strtoupper($request->firstname));
        if ($request->othername != null) {
            $upd["othername"] = trim(strtoupper($request->othername));
        }
        $upd["flastname"] = trim(strtoupper($request->flastname));

        if (strcasecmp(trim(strtoupper($request->firstname)), $user["firstname"]) != 0 ||
                strcasecmp(strtoupper(trim($request->lastname)), $user["flastname"]) != 0 ||
                $request->countryid != $user["country_id"]) {
            $upd["email"] = $email = $this->editEmail($request, $user);
        }


        $upd["slastname"] = trim(strtoupper($request->slastname));
        $upd["active"] = true; //user is active predeterminated
        $upd["updated"] = Carbon::now();
        $upd["updated_by"] = auth($this->guard)->id();

        \DB::beginTransaction();
        try {
            $user->update($upd);
            \DB::commit();
            Log::debug("Method 'editUser' finish successfully");
            return response()->json([
                        'data' => [
                            'status' => "200",
                            'type' => "success",
                            'detail_en' => "The user was editado correctly",
                            'detail_es' => "El usuario fue editado correctamente"
                        ]
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            throw $e;
        }
    }

    public function editEmail($request, $user) {
        if (strcasecmp(trim(strtoupper($request->firstname)), $user["firstname"]) == 0 &&
                strcasecmp(trim(strtoupper($request->lastname)), $user["lastname"]) == 0 &&
                $request->countryid != $user["country_id"]) {
            $oldCountry = Country::findOrFail($user["country_id"]);
            $newCountry = Country::findOrFail($request->countryid);
            $email = str_replace("@cidenet.com." . $oldCountry["abbrev"], "@cidenet.com." . $newCountry["abbrev"], $user["email"]);
            return $email;
        }

        if (strcasecmp(trim($request->firstname), $user["firstname"]) != 0 ||
                strcasecmp(trim($request->lastname), $user["flastname"]) != 0) {
            $email = $this->createEmail($request);
            return $email;
        }
    }
}
