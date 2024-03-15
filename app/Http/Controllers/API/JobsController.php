<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        try {
            //fetch all Job Listings
            $job_listings = JobListing::with('employer')->get();
            return response()->json([
               'status' => true,
               'data' => $job_listings
            ]);
        }catch (\Exception $e)
        {
            return response()->json([
               'status' => false,
               'message' => $e->getMessage()
            ]);
        }
    }
}
