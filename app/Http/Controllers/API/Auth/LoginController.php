<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //Check the role chosen, then choose the role accordingly
        $validator = Validator::make($request->all(), [
           'role_id' => 'required',
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
        if (!$user && $request->input('role_id') === '1'){
            return response()->json([
               'success' => 'false',
               'message' => ' No Candidate found with this email address'
            ]);
        }
        elseif (!$user && $request->input('role_id') === '2')
        {
            return response()->json([
                'success' => 'false',
                'message' => ' No Employer found with this email address'
            ]);
        }
        elseif (!$user && $request->input('role_id') === '3')
        {
            return response()->json([
                'success' => 'false',
                'message' => ' No BPO found with this email address'
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
