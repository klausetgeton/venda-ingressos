<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Hash;
use App\Model\User;

class APIController extends Controller
{
   public function index(){
     return "asssdello";
   }

   public function register(Request $request)
    {        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);

        return self::authenticate($request);
        // return response()->json(['result'=>true]);
    }

    public static function authenticate(Request $request) {

        $credentials = $request->only(['email', 'password']);

        try {
            if( ! $token = JWTAuth::attempt($credentials) ){
                return response()->json(['error' => "Credenciais invalidas"], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => "Deu erro!"], 500);
        }

        $user = JWTAuth::toUser($token);

        return response()->json([
            'id_token' => $token,
            'user' => $user
        ], 200);
    }


    public function pegausuario()
    {
        try
        {
            $user = JWTAuth::parseToken()->toUser();

            if( ! $user )
            {
                return response()->errorNotFound("User not found");
            }
        }
        catch (TokenInvalidException $e)
        {
            return response()->error(['Token is invalid']);
        }
        catch (TokenExpiredException $e)
        {
            return response()->error(['Token is expired']);
        }
        catch (TokenBlackListedException $e)
        {
            return response()->error(['Token is blacklisted']);
        }

        return response()->json(['user' => $user], 200);
    }
}
