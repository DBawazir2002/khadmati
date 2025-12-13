<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Interfaces\Offer\IOfferService;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    private IOfferService $offerService;

    public function __construct(IOfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = ($this->offerService->index([]))->toResourceCollection();

        return sendSuccessResponse(data: $offers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $data = $request->validated();

        $offer = ($this->offerService->store($data))->toResource();

        return sendSuccessResponse(message: 'تم انشاء العرض بنجاح',data: $offer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return sendSuccessResponse(message: 'تم ارجاع العرض بنجاح',data: $offer->toResource());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, string $id)
    {
        $data = $request->validated();

        $offer = ($this->offerService->update(id: $id, data: $data))->toResource();

        return sendSuccessResponse(message: 'تم تحديث العرض بنجاح',data: $offer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->offerService->delete(id: $id);

        return sendSuccessResponse(message: __('messages.delete_data'));
    }
}
