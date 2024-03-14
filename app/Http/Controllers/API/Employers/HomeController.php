<?php

namespace App\Http\Controllers\API\Employers;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //return data for the Employers Dashboard
        $employee = auth()->user();
        $job_listings = auth()->user()->job_listings();
        $data = [$employee, $job_listings];
        return response()->json([
           'status' => true,
           'data' => $data,
        ]);
        //JobPosting::where('employer_id', auth()->guard('sanctum')->id())->paginate();
    }
}
