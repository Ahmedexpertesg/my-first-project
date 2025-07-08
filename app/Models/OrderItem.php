<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- ADD THIS LINE
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- ADD THIS LINE

class OrderItem extends Model
{
    use HasFactory; // <-- ADD THIS LINE (if you're using factories)

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price', // This should be the price per unit at the time of order
        // Add any other specific columns you have in your 'order_items' table here
    ];

    /**
     * An order item belongs to one product.
     */
    public function product(): BelongsTo // <-- Added return type hint
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * An order item belongs to one order.
     * This is essential for navigating from an item back to its parent order.
     */
    public function order(): BelongsTo // <-- ADD THIS RELATIONSHIP
    {
        return $this->belongsTo(Order::class);
    }

    // You might also consider accessors if you want to get item subtotal directly:
    // protected function subtotal(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => $this->quantity * $this->price,
    //     );
    // }
}
