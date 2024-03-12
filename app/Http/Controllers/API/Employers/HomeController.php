<?php

namespace App\Http\Controllers\API\Employers;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //return data for the Employers Dashboard
        JobPosting::where('employer_id', auth()->guard('sanctum')->id())->paginate();
    }
}
