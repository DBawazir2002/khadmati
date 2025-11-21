<?php

namespace App\Models;

use App\Policies\CategoryPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[UsePolicy(CategoryPolicy::class)]
class Category extends Model
{
    use HasUuids, InteractsWithMedia;

    protected $fillable = [
        'name',
        'icon',
        'description'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
