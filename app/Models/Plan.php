<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'billing_period',
        'max_keys',
        'is_active',
        'sort_order',
        'stripe_price_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'max_keys' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activationKeys()
    {
        return $this->hasMany(ActivationKey::class);
    }

    public function features()
    {
        return $this->hasMany(PlanFeature::class)->orderBy('sort_order');
    }
}
