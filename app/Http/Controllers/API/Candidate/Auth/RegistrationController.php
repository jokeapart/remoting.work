<?php

namespace App\Http\Controllers\API\Candidate\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => $validator->errors()->first()
            ]);
        }

        // create a new user with the user role type
        $user = User::create([
           'firstname' => $request->input('firstname'),
           'lastname' => $request->input('lastname'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
           'role_id' => $request->input('role_id'),
           'phone_number' => $request->input('phone_number'),
           'status' => 'Pending Approval',
        ]);

        if ($user){
            //Update the Candidates Table if after creating the user's table
            Candidate::create([
               'user_id' => $user->id,
               'subscription_type' => 'Monthly',
               'verified_status' => 'Not Verified',
               'bpo_id' => '1',
               'profile_image' => '//image//move//folder',
               'resume' => '//image//move//folder//resume',
            ]);
        }

        $user->createToken('token')->accessToken;
        return  response()->json([
            'success' => true,
            'message' => 'Candidate Registered Successfully'
        ]);

    }
}
