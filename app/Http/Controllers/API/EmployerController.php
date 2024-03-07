<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\UpdateEmployerRequest;
use App\Http\Requests\Employer\CreateEmployerRequest;
use App\Http\Resources\Employer\EmployerResource;
use App\Models\Employer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployerController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $employers = Employer::useFilters()->dynamicPaginate();

        return EmployerResource::collection($employers);
    }

    public function store(CreateEmployerRequest $request): JsonResponse
    {
        $employer = Employer::create($request->validated());

        return $this->responseCreated('Employer created successfully', new EmployerResource($employer));
    }

    public function show(Employer $employer): JsonResponse
    {
        return $this->responseSuccess(null, new EmployerResource($employer));
    }

    public function update(UpdateEmployerRequest $request, Employer $employer): JsonResponse
    {
        $employer->update($request->validated());

        return $this->responseSuccess('Employer updated Successfully', new EmployerResource($employer));
    }

    public function destroy(Employer $employer): JsonResponse
    {
        $employer->delete();

        return $this->responseDeleted();
    }

   
}
