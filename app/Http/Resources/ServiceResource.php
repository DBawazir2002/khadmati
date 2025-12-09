<?php

namespace App\Http\Resources;

use App\Traits\GetImageUrlTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'image' => $this->getImageUrl(),
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'users_count' => $this->users->count(),
            'users' => UserResource::collection($this->users),
        ];
    }
}
