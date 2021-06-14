<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use App\Models\Security\Country;
use Carbon\Carbon;

class EditUserController extends Controller {

    public function edit(Request $request,$id) {
        $user = User::findOrFail($id);
        if ($request->numberid != $user["numberid"] && 
                User::where("numberid", trim($request->numberid))->count() > 0) {
            return response()->json([
                        'status' => "204",
                        'result' => "Ya existe un usuario con esta identificación"
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
        
         if(strcasecmp(trim(strtoupper($request->firstname)) , $user["firstname"]) != 0 ||
                strcasecmp(strtoupper(trim($request->lastname)) , $user["lastname"]) != 0 ||
                   $request->countryid != $user["country_id"]){
                $upd["email"] =  $email = $this->editEmail($request, $user);
            }   
                       
             
        $upd["slastname"] = trim(strtoupper($request->slastname));
        $upd["active"] = true; //user is active predeterminated
        $upd["updated"] = Carbon::now();
        $upd["updated_by"] = auth($this->guard)->id();

        \DB::beginTransaction();
        try {
            $user->update($upd);
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
    
      public function editEmail($request,$user) {          
          if(strcasecmp(trim(strtoupper($request->firstname)) , $user["firstname"]) == 0 &&
                strcasecmp(trim(strtoupper($request->lastname)) , $user["lastname"]) == 0 &&
                $request->countryid != $user["country_id"]){
              $oldCountry = Country::findOrFail($user["country_id"]);
              $newCountry = Country::findOrFail($request->countryid);
              $email = str_replace("@cidenet.com.".$oldCountry["abbrev"],"@cidenet.com.".$newCountry["abbrev"], $user["email"]);
              return $email;              
          }
          
            if(strcasecmp(trim($request->firstname) , $user["firstname"]) != 0 ||
                strcasecmp(trim($request->lastname) , $user["lastname"]) != 0){
                  $email = $this->createEmail($request);
              return $email;
            }
            
           
          
          
          
                  
     
    }
}
