<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{
    public function index()
    {
        //return all job applied by this candidate
        try {
            $jobs_applied = JobApplication::where('candidate_id', auth()->id())->get();
            return response()->json([
               'status' => true,
               'data' => $jobs_applied
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function apply(Request $request)
    {
        //This function allows the candidate apply for a job
        try {
            $validator = Validator::make($request->all(), [
                'job_listing_id' => 'required',
                'candidate_id' => 'required',
                'employer_id' => 'required',
            ]);
            if ($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            JobApplication::create([
               'job_listing_id' => $request->input('job_listing_id'),
               'candidate_id' => $request->input('candidate_id'),
               'employer_id' => $request->input('employer_id'),
               'interview_id' => $request->input('interview_id'),
               'status' => 'Pending',
            ]);

            return response()->json([
               'status' => true,
               'message' => 'Job successfully applied'
            ]);

        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }
}
