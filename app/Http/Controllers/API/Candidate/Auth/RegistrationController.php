<?php

namespace App\Http\Controllers\API\Candidate\Auth;

use App\Http\Controllers\Controller;
use App\Models\BPO;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{

    public function register(Request $request)
    {

        if ($request->input('role_id') === '1'){
            //Validate the compulsory fields for the Candidate and insert the records
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'password' => 'required',
                'phone_number' => 'required',
                'role_id' => 'required',
                'subscription_type' => 'required',
                'bpo_id' => 'required',
                'profile_image' => 'required',
                'resume' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            //Create a new Candidate
            $candidate = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $request->input('role_id'),
                'phone_number' => $request->input('phone_number'),
                'status' => 'Pending Approval',
            ]);

            //Update the Candidate's Table
            Candidate::create([
                'user_id' => $candidate->id,
                'bpo_id' => $request->input('bpo_id'),
                //Fixed the three fields below
                'subscription_type' => $request->input('subscription_type'),
                'profile_image' => $request->input('profile_image'),
                'resume' => $request->input('resume'),
            ]);
            //Create the Candidate Access token
            $candidate->createToken('token')->accessToken;
            return  response()->json([
                'success' => true,
                'message' => 'Candidate Registered Successfully but pending Approval'
            ]);
        }
        elseif ($request->input('role_id') === '2'){
            //Validate the compulsory fields for the Employer and insert the records
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'password' => 'required',
                'phone_number' => 'required',
                'role_id' => 'required',
                'company_name' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            $employer = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $request->input('role_id'),
                'phone_number' => $request->input('phone_number'),
                'status' => 'Pending Approval',
            ]);
            Employer::create([
                'user_id' => $employer->id,
                'company_name' => $request->input('company_name'),
            ]);

            $employer->createToken('token')->accessToken;
            return  response()->json([
                'success' => true,
                'message' => 'Employer Registered Successfully but pending Approval'
            ]);
        }

        elseif ($request->input('role_id') === '3'){
            //Validate the fields that only belongs to the BPO's and insert records into the database
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'password' => 'required',
                'phone_number' => 'required',
                'role_id' => 'required',
                'bpo_name' => 'required',
                'profile_image' => 'required',
                'office_image' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            //Create the BPO User
            $bpo = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $request->input('role_id'),
                'phone_number' => $request->input('phone_number'),
                'status' => 'Pending Approval',
            ]);
            //Associate the user with the BPO table
            BPO::create([
                'user_id' => $bpo->id,
                'bpo_name' => $request->input('bpo_name'),
                //Work on the Profile Image and Office Image
                'profile_image' => $request->input('profile_image'),
                'office_image' => $request->input('office_image')
            ]);

            $bpo->createToken('token')->accessToken;
            return  response()->json([
                'success' => true,
                'message' => 'BPO Registered Successfully but pending Approval'
            ]);
        }
    }



}
