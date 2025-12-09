<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
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

    private function getImageUrl(): ?string
    {
        $imageUrl = null;
        if($mediaItem = $this->getFirstMedia('image')){
            $storageUrl = (Storage::url($mediaItem->id . '/' . $mediaItem->file_name));
            $imageUrl = app()->isProduction() ?  'public/' . $storageUrl : $storageUrl;
        }
        return $imageUrl;
    }
}
