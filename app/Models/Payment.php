<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'payment_id',
        'order_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'package_name',
        'fee',
        'contact',
        'email',
        'card_id',
        'international',
        'payment_response',
        'payment_created_at',
    ];

    protected $casts = [
        'payment_response' => 'array',
        'international' => 'boolean',
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'payment_created_at' => 'datetime',
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the package that was purchased.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the user package relationships for this payment.
     */
    public function userHasPackages(): HasMany
    {
        return $this->hasMany(UserHasPackage::class);
    }

    /**
     * Scope for successful payments only.
     */
    public function scopeSuccessful($query)
    {
        return $query->whereIn('status', ['captured', 'authorized']);
    }

    /**
     * Scope for failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Check if payment is successful.
     */
    public function isSuccessful(): bool
    {
        return in_array($this->status, ['captured', 'authorized']);
    }

    /**
     * Get formatted amount with currency.
     */
    public function getFormattedAmountAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }
}
