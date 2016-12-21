<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('id_fb', $request->facebookId)->first();
        if ($user == null) {
            $user = User::create([
                'id_fb' => (int) $request->facebookId,
                'name' => $request->name,
                'avatar' => $request->avatar,
                'fb_token' => $request->fbToken,
            ]);
        }
        $user->token = 'tuannt_' . md5($request->fbToken);
        $user->save();
        return json_encode([
            'user_id' => $user->id,
            'user_token' => $user->token
        ]);
    }

    public function logout(Request $request)
    {
        $logoutSuccess = true;
        $userId = $request->userId;
        $userToken = $request->userToken;

        $user = User::find($userId);
        if ($user && ($user->token == $userToken)) {
            $user->token = null;
            $user->save();
        } else {
            $logoutSuccess = false;
        }

        return json_encode([
            'logout' => $logoutSuccess
        ]);
    }
}
