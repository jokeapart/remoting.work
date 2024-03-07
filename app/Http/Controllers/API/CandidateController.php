<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\UpdateCandidateRequest;
use App\Http\Requests\Candidate\CreateCandidateRequest;
use App\Http\Resources\Candidate\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CandidateController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $candidates = Candidate::useFilters()->dynamicPaginate();

        return CandidateResource::collection($candidates);
    }

    public function store(CreateCandidateRequest $request): JsonResponse
    {
        $candidate = Candidate::create($request->validated());

        return $this->responseCreated('Candidate created successfully', new CandidateResource($candidate));
    }

    public function show(Candidate $candidate): JsonResponse
    {
        return $this->responseSuccess(null, new CandidateResource($candidate));
    }

    public function update(UpdateCandidateRequest $request, Candidate $candidate): JsonResponse
    {
        $candidate->update($request->validated());

        return $this->responseSuccess('Candidate updated Successfully', new CandidateResource($candidate));
    }

    public function destroy(Candidate $candidate): JsonResponse
    {
        $candidate->delete();

        return $this->responseDeleted();
    }

   
}
