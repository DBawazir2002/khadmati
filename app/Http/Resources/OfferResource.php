<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $offerStartDate = Carbon::parse($this->start_date);
        $offerEndDate = Carbon::parse($this->end_date);
        $currentDate = Carbon::now();

        $remainingDay = match ($offerEndDate->isFuture()) {
            true => $currentDate->diffInDays($offerEndDate),
            default => 0
        };

        return [
            'id' => $this->id,
            'name' => $this->name,
            'details' => $this->details,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'start_date' => $this->start_date->format('Y-m-d'),
            'end_date' => $this->end_date->format('Y-m-d'),
            'duration' => $offerStartDate->diffInDays($this->end_date),
            'remaining_days' => $remainingDay,
            'image' => $this->getFirstMediaUrl('image'),
        ];
    }

}
