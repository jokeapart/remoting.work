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
        try {
            if ($request->input('role') === 'candidate'){
                //Validate the compulsory fields for the Candidate and insert the records
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email'=> 'required|email|unique:users',
                    'password' => 'required',
                    'phone_number' => 'required',
                    'role' => 'required',
                    'skills' => 'required',
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

                //Create a new Candidates
                $candidate = User::create([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role' => $request->input('role'),
                    'phone_number' => $request->input('phone_number'),
                    'status' => 'Pending Approval',
                ]);

                //Update the Candidate Table
                Candidate::create([
                    'user_id' => $candidate->id,
                    'bpo_id' => $request->input('bpo_id'),
                    'verified_status' => $request->input('verified_status'),
                    'subscription_type' => $request->input('subscription_type'),
                    'skill' => $request->input('skills'), 
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
            elseif ($request->input('role') === 'employer'){
                //Validate the compulsory fields for the Employer and insert the records
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'password' => 'required',
                    'phone_number' => 'required',
                    'role' => 'required',
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
                    'role' => $request->input('role'),
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

            elseif ($request->input('role') === 'bpo'){
                //Validate the fields that only belongs to the BPO's and insert records into the database
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'password' => 'required',
                    'phone_number' => 'required',
                    'role' => 'required',
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
                    'role' => $request->input('role'),
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
        catch (\Exception $e){
            return response()->json([
               'status' => false,
               'message' => $e->getMessage()
            ]);
        }
    }

    public function registration_data()
    {
        try {
           //Get all the BPO's and loop them for the registration page
            $bpo = BPO::all();
            return \response()->json([
               'status' => true,
               'message' => 'This is the BPOs data to be used on the Registration page for Candidates',
                'data' => $bpo
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }



}
