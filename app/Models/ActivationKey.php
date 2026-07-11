<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivationKey extends Model
{
    protected $fillable = [
        'user_id',
        'owner_id',
        'plan_id',
        'key',
        'client_name',
        'client_email',
        'domain',
        'product_type',
        'status',
        'activated_at',
        'expires_at',
        'last_validated_at',
        'metadata',
    ];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    protected function casts(): array
    {
        return [
            'activated_at' => 'datetime',
            'expires_at' => 'datetime',
            'last_validated_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function events()
    {
        return $this->hasMany(KeyEvent::class);
    }

    public function isValid(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }
        return true;
    }
}
