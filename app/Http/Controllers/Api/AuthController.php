<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('id_fb', $request->facebookId)->first();
        DB::beginTransaction();
        try {
            if ($user == null) {
                $user = new User;
                $user->id_fb = $request->facebookId;
                $user->name = $request->name;
                $user->avatar = $request->avatar;
                $user->fb_token = $request->fbToken;
                $user->password = null;
                $user->address = null;
                $user->phone = null;
            }
            $user->token = 'tuannt_' . md5($request->fbToken);
            $user->save();
            DB::commit();
            return json_encode([
                'user_id' => $user->id,
                'user_token' => $user->token
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode([
                'user_id' => 'null',
                'user_token' => 'null'
            ]);
        }

        return json_encode([
                'user_id' => 'null',
                'user_token' => 'null'
            ]);
    }

    public function logout(Request $request)
    {
        $logoutSuccess = true;
        $userId = $request->userId;
        $userToken = $request->userToken;

        DB::beginTransaction();
        try {
            $user = User::find($userId);
            if ($user && ($user->token == $userToken)) {
                $user->token = null;
                $user->save();
            } else {
                $logoutSuccess = false;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $logoutSuccess = false;
        }

        return json_encode([
            'logout' => $logoutSuccess
        ]);
    }
}
