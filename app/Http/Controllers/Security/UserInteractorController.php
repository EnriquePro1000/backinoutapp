<?php

namespace App\Http\Controllers\Security;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Security\User;

class UserInteractorController extends Controller {

    public function getUsers() {
        Log::debug("Method 'getUsers' initialited");
        Log::debug("Method 'getUsers' finish successfully");
        return response()->json([
                    'data' => [
                        'status' => "200",
                        'type' => "success",
                        'detail_en' => "The users where get successfully",
                        'detail_es' => "Los usuarios fueron obtenidos correctamente",
                        'users' => $this->userList()
                    ]
        ]);
    }

    public function getUser($id) {
        Log::debug("Method 'getUser' initialited");
        Log::debug("Method 'getUser' finish successfully");
        $user = User::findOrFail($id);
        if ($user["othername"] == null) {
            $user["othername"] = "";
        }
        return response()->json([
                    'data' => [
                        'status' => "200",
                        'type' => "user",
                        'detail_en' => "The user was get successfully",
                        'detail_es' => "El usuario fue obtenido correctamente",
                        'id' => $user["id"],
                        'attributes' => [
                            'typeid' => $user["typeid_id"],
                            'numberid' => $user['numberid'],
                            'areaid' => $user['area_id'],
                            'countryid' => $user['country_id'],
                            'firstname' => $user['firstname'],
                            'othername' => $user['othername'],
                            'flastname' => $user['flastname'],
                            'slastname' => $user['slastname'],
                        ]
                    ]
        ]);
    }

    public function deleteUser($id) {
        Log::debug("Method 'deleteUser' initialited");
        Log::debug("Method 'deleteUser' finish successfully");
        if (User::where("id", $id)->count() > 0) {
            $user = User::findOrFail($id);
            \DB::beginTransaction();
            try {
                $user->delete();
                \DB::commit();
                return response()->json([
                            'data' => [
                                'status' => "200",
                                'type' => "success",
                                'detail_en' => "The user was delete successfully",
                                'detail_es' => "El usuario fue eliminado correctamente"
                            ]
                ]);
            } catch (\Throwable $e) {
                \DB::rollback();
                throw $e;
            }
        } else {
            return response()->json([
                        'data' => [
                            'status' => "204",
                            'type' => "error",
                            'detail_en' => "The user was delete successfully",
                            'detail_es' => "El usuario fue eliminado correctamente"
                        ]
            ]);
        }
    }

}
