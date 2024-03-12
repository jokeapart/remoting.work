<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPosting\UpdateJobPostingRequest;
use App\Http\Requests\JobPosting\CreateJobPostingRequest;
use App\Http\Resources\JobPosting\JobPostingResource;
use App\Models\JobPosting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JobPostingController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $jobPostings = JobPosting::useFilters()->dynamicPaginate();

        return JobPostingResource::collection($jobPostings);
    }

    public function store(CreateJobPostingRequest $request): JsonResponse
    {
        $jobPosting = JobPosting::create($request->validated());

        return $this->responseCreated('JobPosting created successfully', new JobPostingResource($jobPosting));
    }

    public function show(JobPosting $jobPosting): JsonResponse
    {
        return $this->responseSuccess(null, new JobPostingResource($jobPosting));
    }

    public function update(UpdateJobPostingRequest $request, JobPosting $jobPosting): JsonResponse
    {
        $jobPosting->update($request->validated());

        return $this->responseSuccess('JobPosting updated Successfully', new JobPostingResource($jobPosting));
    }

    public function destroy(JobPosting $jobPosting): JsonResponse
    {
        $jobPosting->delete();

        return $this->responseDeleted();
    }

   
}
