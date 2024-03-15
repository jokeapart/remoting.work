<?php

namespace App\Http\Controllers\API\BPO;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class BPOHomeController extends Controller
{
    public function index()
    {
        try {
            //Get the data for profile and job application history
            $bpo = auth()->user()->load('bpo_details');
            $bpo_candidates = Candidate::where('bpo_id', auth()->id())->with('candidate_details')->get();
            $data = [$bpo, $bpo_candidates];
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
            $profile = auth()->user()->load('bpo');
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


}
