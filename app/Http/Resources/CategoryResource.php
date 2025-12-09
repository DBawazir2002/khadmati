<?php

namespace App\Http\Resources;

use App\Traits\GetImageUrlTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    use GetImageUrlTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->getImageUrl(),
            'services' => $this->when($this->relationLoaded('services'), ServiceResource::collection($this->services))
        ];
    }

}
