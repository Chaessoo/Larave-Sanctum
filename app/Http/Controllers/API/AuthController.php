<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required|max:100",
            "email" => "required|email:dns",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if ($validator->fails())
        {
            return response()->json([
                "succes" => false,
                "message" => "password atau nama salah",
                "data" => $validator->errors()
            ]);
        }
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);

        $success["token"] = $user->createToken("auth_token")->plainTextToken;
        $success["name"] = $user->name;

        return response()->json([
            "success" => true,
            "message" => "Registration success",
            "data" => $success
        ]);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(["email" =>$request->email,"password" => $request->password]))
        {
            $auth = Auth::user();
            $success["token"] = $auth->createToken("auth_token")->plainTextToken;
            $success["name"] = $auth->name;
            $success["email"] = $auth->email;

            return response()->json([
                "success" => true,
                "message" => "login sukses",
                "data" => $success
            ]);
        }else
        {
            return response()->json([
                "success" => false,
                "message" => "email atau password salah",
                "data" => null
            ]);
        }
    }

    public function profil(Request $req)
    {
        $user = $req->user()->name;

        return response()->json([
            "message" => "ini profil kamu " .$user. " yg baik hati"
        ]);
    }


}
