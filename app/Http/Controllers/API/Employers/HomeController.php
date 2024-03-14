<?php

namespace App\Http\Controllers\API\Employers;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class HomeController extends Controller
{
    public function index()
    {
        //return data for the Employers Dashboard
        try {
            $employer = auth()->user()->load('employer');
            $employer_job_listings = JobListing::where('employer_id', auth()->user()->id)->get();
            $data = [$employer, $employer_job_listings];
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(): \Illuminate\Http\JsonResponse
    {
        try {
            $profile = auth()->user()->load('employer');
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
                $company_name = $request->input('company_name') ? $request->input('company_name') : $profile->employer->company_name;

                $profile->update([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phone_number' => $phone_number,
                ]);

                $profile->employer()->update([
                    'company_name' => $company_name
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Profile successfully updated'
                ]);
            }
            return response()->json([
                'status' => false,
                'Message' => 'This employer is not Authorized to perform this action'
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
