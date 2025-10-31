<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Interfaces\Service\IServiceService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private IServiceService $service;

    public function __construct(IServiceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = ($this->service->index([]))->toResourceCollection();

        return sendSuccessResponse(data: $services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();

        $service = ($this->service->store($data))->toResource();

        return sendSuccessResponse(message: 'تم انشاء الخدمة بنجاح',data: $service);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return sendSuccessResponse(message: 'تم ارجاع الخدمة بنجاح',data: $service->toResource());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        $data = $request->validated();

        $service = ($this->service->update(id: $id, data: $data))->toResource();

        return sendSuccessResponse(message: 'تم ارجاع الخدمة بنجاح',data: $service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete(id: $id);

        return sendSuccessResponse(status_code: 204);
    }
}
