<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'hardware_category_id',
    'name',
    'asset_tag',
    'serial_number',
    'status',
    'location',
    'assigned_to_user_id',
    'notes',
])]
class HardwareItem extends Model
{
    /** @use HasFactory<\Database\Factories\HardwareItemFactory> */
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(HardwareCategory::class, 'hardware_category_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}

