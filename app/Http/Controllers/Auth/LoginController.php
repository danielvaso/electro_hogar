<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        return
            view('auth.login');
    }

    public function register(Request $request)
    {


        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            DB::commit();

            return response()->json([
                "status" => true,
                "data" => $user,

            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => "Registration failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid email or password"
            ]);
        }
        $user = Auth::user();
        Session::put('user', $user);
        return response()->json([
            "status" => true,
            "data" => $user,
        ]);
    }

    public function me()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ]);
        }
        return response()->json([
            "status" => true,
            "data" => $user
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
