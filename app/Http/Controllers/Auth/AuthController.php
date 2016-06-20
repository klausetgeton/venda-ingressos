<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        // $this->redirectPath = '/admin/dashboard';
    }


    // public static function authenticate(Request $request) {

    //   $credentials = $request->only(['email', 'password']);

    //   try {
    //     if( ! $token = JWTAuth::attempt($credentials) ){
    //       return response()->json(['error' => "Credenciais invalidas"], 401);
    //     }
    //   } catch (JWTException $e) {
    //     return response()->json(['error' => "Deu erro!"], 500);
    //   }

    //   $user = JWTAuth::toUser($token);

    //   return response()->json([
    //     'id_token' => $token,
    //     'user' => $user
    //   ], 200);

    // }


    public function pegausuario(){


      die('asdasda');
      return "asdasda";

      // return response()->json(['asda' => 'asdasdasd'], 200);

      // try {
      //   $user = JWTAuth::parseToken()->toUser();
      //
      //   if( ! $user ) {
      //     return response()->errorNotFound("User not found");
      //   }
      // } catch (TokenInvalidException $e) {
      //   return response()->error(['Token is invalid']);
      // } catch (TokenExpiredException $e) {
      //   return response()->error(['Token is expired']);
      // } catch (TokenBlackListedException $e) {
      //   return response()->error(['Token is blacklisted']);
      // }
      //
      // return response()->json(['user' => $user], 200);
    }








    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
