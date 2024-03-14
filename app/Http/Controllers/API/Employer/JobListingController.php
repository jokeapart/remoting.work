<?php

namespace App\Http\Controllers\Api\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobListingController extends Controller
{
    public function index()
    {
        try {
            $employer_job_listings = JobListing::where('employer_id', auth()->user()->id)->get();
            return response()->json([
                'status' => true,
                'data' => $employer_job_listings,
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'skills_required' => 'required',
                'location' => 'required',
                'type' => 'required'
            ]);
            if ($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            JobListing::create([
                'employer_id' => auth()->user()->id,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'skills_required' => $request->input('skills_required'),
                'requirements' => $request->input('requirements'),
                'location' => $request->input('location'),
                'type' => $request->input('type'),
                'status' => 'Active',
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Job Listing Successfully Created'
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request,  $id)
    {
        //Select from the JobListing table where the id = $id
        try {
            //Check for the data from the form
            $jobListing = JobListing::find($id);
            $title = $request->input('title') ? $request->input('title') : $jobListing->title;
            $description = $request->input('description') ? $request->input('description') : $jobListing->description;
            $skills_required = $request->input('skills_required') ? $request->input('skills_required') : $jobListing->skills_required;
            $requirements = $request->input('requirements') ? $request->input('requirements') : $jobListing->requirements;
            $location = $request->input('location') ? $request->input('location') : $jobListing->location;
            $type = $request->input('type') ? $request->input('type') : $jobListing->type;
            $status = $request->input('status') ? $request->input('status') : $jobListing->status;

            //Update the Job Listing
            $jobListing->update([
               'title' => $title,
               'description' => $description,
               'skills_required' => $skills_required,
               'requirements' => $requirements,
               'location' => $location,
               'type' => $type,
               'status' => $status,
            ]);
            //Return response back to the employer
            return response()->json([
               'status' => true,
               'message' => 'Job Listing Successfully Updated',
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'status' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $jobListing = JobListing::find($id);
            $jobListing->delete();
            return response()->json([
               'status' => true,
               'message' => 'Job Listing successfully deleted'
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
