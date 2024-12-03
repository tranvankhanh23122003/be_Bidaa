<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    /**
     * Xử lý đăng ký người dùng mà không gửi email kích hoạt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function dangKy(Request $request)
    {
        $user = User::where('phoneNumber', $request->phoneNumber)->first();

        if ($user) {
            return response()->json([
                'message'   =>  'Số điện thoại đã tồn tại trong hệ thống!',
                'status'    =>  false
            ]);
        }

        User::create([
            'userName' => $request->userName,
            'fullName' => $request->fullName,
            'phoneNumber' => $request->phoneNumber,
            'role' => 1,
            'avatar' => "abc",
            'status' => 1,
            'point' => 0,
            'password'      =>  bcrypt($request->password),
        ]);

        return response()->json([
            'message'   =>  'Tao tại tài khoản rồi nhé!',
            'status'    =>  true
        ]);
    }

    public function dangNhap(Request $request)
    {
        $credentials = $request->only('phoneNumber', 'password');

        $user = User::where('phoneNumber', $credentials['phoneNumber'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::attempt(['phoneNumber' => $request->phoneNumber, 'password' => $request->password]);
            $token = Auth::user()->createToken(
                'authToken',
                ['*'],
                now()->addDays(7)
            )->plainTextToken;

            return response()->json([
                'message' => 'Ok, đã đăng nhập rồi nghen!',
                'status' => true,
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'message' => 'Đăng nhập thất bại!',
                'status' => false
            ]);
        }
    }
    public function checkAdmin()
    {
         $check = Auth::guard('sanctum')->user();

        if($check && $check instanceof \App\Models\User)
        {
            return response()->json([
                'status'    =>  true
            ]);
        } else {
            return response()->json([
                'status'        =>  false,
                'message'       =>  "Bạn chưa đăng nhập hệ thống!"
            ]);
        }
    }

    public function getUser(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }

    // public function logout()
    // {
    //     $user = Auth::guard('sanctum')->user();

    //     if($user) {
    //         DB::table('personal_access_tokens')
    //         ->where('id', $user->currentAccessToken()->id)
    //         ->delete();

    //         return response()->json([
    //             'message'   =>  'Đã đăng xuất thành công!',
    //             'status'    =>  true,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message'   =>  'Bạn cần đăng nhập hệ thống',
    //             'status'    =>  false,
    //         ]);
    //     }
    // }

}
