<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Make sure this is present if you use items()
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- ADD THIS LINE
use App\Models\User; // <-- ADD THIS LINE (assuming your User model is in App\Models)

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'user_id',
    ];

    /**
     * Get the user (customer) that owns the order.
     */
    public function user(): BelongsTo // This type hint requires 'use BelongsTo;'
    {
        return $this->belongsTo(User::class); // This requires 'use App\Models\User;'
    }

    /**
     * Get the order items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
