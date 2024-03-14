<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

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
}
