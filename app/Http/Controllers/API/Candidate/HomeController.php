<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            //Get the data for profile and job application history
            $candidate = auth()->user()->load('candidate');
            $job_applied = JobApplication::where('candidate_id', auth()->id())->with('job_listing', 'employer')->get();
            $data = [$candidate, $job_applied];
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function profile(): \Illuminate\Http\JsonResponse
    {
        try {
            $profile = auth()->user()->load('candidate');
            return response()->json([
                'status' => true,
                'data' => $profile
            ]);
        }   catch (\Exception $e)
        {
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function profile_update(Request $request, $id)
    {
        try {
            //Check to make sure that the id passed belongs to the logged-in user
            if (auth()->id() == $id)
            {
                $profile = auth()->user();
                //Get the data from the form
                $firstname = $request->input('firstname') ? $request->input('firstname') : $profile->firstname;
                $lastname = $request->input('lastname') ? $request->input('lastname') : $profile->lastname;
                $phone_number = $request->input('phone_number') ? $request->input('phone_number') : $profile->phone_number;
                $subscription_type = $request->input('subscription_type') ? $request->input('subscription_type') : $profile->candidate->subscription_type;
                $verified_status = $request->input('verified_status') ? $request->input('verified_status') : $profile->candidate->verified_status;
                $bpo_id = $request->input('bpo_id') ? $request->input('bpo_id') : $profile->candidate->bpo_id;
                $profile_image = $request->input('profile_image') ? $request->input('profile_image') : $profile->candidate->profile_image;
                $resume = $request->input('resume') ? $request->input('resume') : $profile->candidate->resume;

                $profile->update([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phone_number' => $phone_number,
                ]);

                $profile->candidate()->update([
                    'subscription_type' => $subscription_type,
                    'verified_status' => $verified_status,
                    'bpo_id' => $bpo_id,
                    'profile_image' => $profile_image,
                    'resume' => $resume,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Profile successfully updated'
                ]);
            }
            return response()->json([
                'status' => false,
                'Message' => 'This Candidate is not Authorized to perform this action'
            ]);

        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }

    }
}
