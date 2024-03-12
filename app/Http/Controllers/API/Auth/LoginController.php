<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //Check the role chosen, then choose the role accordingly
        $validator = Validator::make($request->all(), [
           'email' => 'required',
           'password' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json([
               'success' => false,
               'message' => $validator->errors()->first()
            ]);
        }

        $user = User::where('email', $request->input('email'))->first();
        if (!$user){
            return response()->json([
               'success' => 'false',
               'message' => 'This user does not exist'
            ]);
        }elseif (!Hash::check($request->input('password'), $user->password))
        {
            return response()->json([
               'status' => false,
               'message' => "Password didn't match"
            ]);
        }


        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            $user->token = $user->createToken('MyApp')->plainTextToken;
            return  response()->json([
                'success' => true,
                'message' => 'User Login Successfully',
                'data' => $user
            ]);
        }
    }
}
