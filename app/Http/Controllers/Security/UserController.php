<?php

namespace App\Http\Controllers\Security;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;

class UserController extends Controller {

    public function getUsers() {
        return response()->json([
                    'status' => "200",
                    'users' => $this->userList()
        ]);
    }

    public function deleteUser($id) {
        if (User::where("id", $id)->count() > 0) {
            $user = User::findOrFail($id);
            \DB::beginTransaction();
            try {
                $user->delete();
                \DB::commit();
                return response()->json([
                            'status' => "200",
                            'result' => "The user was delete successfully"
                ]);
            } catch (\Throwable $e) {
                \DB::rollback();
                throw $e;
            }
        } else {
            return response()->json([
                        'status' => "204",
                        'result' => "The user not exist or was delete previously",
                        'users' => $this->userList()
            ]);
        }
    }

    protected function userList() {
        return User::select('users.*', 'countries.name as country_name', 'typeid.abbrev as typeid_abbrev')
                        ->join('countries', 'countries.id', '=', 'users.country_id')
                        ->join('typeid', 'typeid.id', '=', 'users.typeid_id')
                        ->where("users.id", "!=", auth($this->guard)->id())
                        ->get();
    }

}
