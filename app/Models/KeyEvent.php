<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyEvent extends Model
{
    protected $fillable = [
        'activation_key_id',
        'event_type',
        'ip_address',
        'user_agent',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    public function activationKey()
    {
        return $this->belongsTo(ActivationKey::class);
    }
}
