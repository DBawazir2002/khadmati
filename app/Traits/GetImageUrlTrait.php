<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait GetImageUrlTrait
{
    private function getImageUrl(): ?string
    {
        $imageUrl = null;
        if($mediaItem = $this->getFirstMedia('image')){
            $storageUrl = (Storage::url($mediaItem->id . '/' . $mediaItem->file_name));
            $imageUrl = url('/public' . $storageUrl);
        }
        return $imageUrl;
    }
}
