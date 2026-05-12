<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]
class HardwareCategory extends Model
{
    /** @use HasFactory<\Database\Factories\HardwareCategoryFactory> */
    use HasFactory;

    public function items(): HasMany
    {
        return $this->hasMany(HardwareItem::class, 'hardware_category_id');
    }
}

