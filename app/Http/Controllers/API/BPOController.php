<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BPO\UpdateBPORequest;
use App\Http\Requests\BPO\CreateBPORequest;
use App\Http\Resources\BPO\BPOResource;
use App\Models\BPO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BPOController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $bPOS = BPO::useFilters()->dynamicPaginate();

        return BPOResource::collection($bPOS);
    }

    public function store(CreateBPORequest $request): JsonResponse
    {
        $bPO = BPO::create($request->validated());

        return $this->responseCreated('BPO created successfully', new BPOResource($bPO));
    }

    public function show(BPO $bPO): JsonResponse
    {
        return $this->responseSuccess(null, new BPOResource($bPO));
    }

    public function update(UpdateBPORequest $request, BPO $bPO): JsonResponse
    {
        $bPO->update($request->validated());

        return $this->responseSuccess('BPO updated Successfully', new BPOResource($bPO));
    }

    public function destroy(BPO $bPO): JsonResponse
    {
        $bPO->delete();

        return $this->responseDeleted();
    }

   
}
