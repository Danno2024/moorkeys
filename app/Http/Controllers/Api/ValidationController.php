<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivationKey;
use App\Models\KeyEvent;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function validate(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'machine_id' => 'nullable|string|max:255',
            'product_type' => 'nullable|string|max:100',
        ]);

        $user = $request->api_user;

        $activationKey = ActivationKey::where('key', $data['key'])
            ->where('user_id', $user->id)
            ->first();

        if (! $activationKey) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid license key.',
                'code' => 'INVALID_KEY',
            ], 404);
        }

        $valid = $activationKey->isValid();

        $logData = [
            'domain' => $data['domain'] ?? null,
            'machine_id' => $data['machine_id'] ?? null,
            'product_type' => $data['product_type'] ?? null,
            'result' => $valid ? 'valid' : 'invalid',
        ];

        $activationKey->events()->create([
            'event_type' => 'validated',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => $logData,
        ]);

        if ($valid) {
            $activationKey->update(['last_validated_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'valid' => $valid,
                'status' => $activationKey->status,
                'expires_at' => $activationKey->expires_at?->toISOString(),
                'activated_at' => $activationKey->activated_at?->toISOString(),
                'last_validated_at' => $activationKey->last_validated_at?->toISOString(),
            ],
        ]);
    }

    public function activate(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'machine_id' => 'nullable|string|max:255',
            'product_type' => 'nullable|string|max:100',
            'metadata' => 'nullable|array',
        ]);

        $user = $request->api_user;

        $activationKey = ActivationKey::where('key', $data['key'])
            ->where('user_id', $user->id)
            ->first();

        if (! $activationKey) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid license key.',
                'code' => 'INVALID_KEY',
            ], 404);
        }

        if (! $activationKey->isValid()) {
            return response()->json([
                'success' => false,
                'error' => 'License key is not active or has expired.',
                'code' => 'KEY_NOT_ACTIVE',
            ], 403);
        }

        $payload = array_merge([
            'domain' => $data['domain'] ?? null,
            'machine_id' => $data['machine_id'] ?? null,
            'product_type' => $data['product_type'] ?? null,
        ], $data['metadata'] ?? []);

        $activationKey->events()->create([
            'event_type' => 'activated',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => $payload,
        ]);

        if (! $activationKey->activated_at) {
            $activationKey->update([
                'activated_at' => now(),
                'last_validated_at' => now(),
                'domain' => $data['domain'] ?? $activationKey->domain,
            ]);
        } else {
            $activationKey->update(['last_validated_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'activated' => true,
                'activated_at' => $activationKey->activated_at->toISOString(),
                'status' => $activationKey->status,
                'expires_at' => $activationKey->expires_at?->toISOString(),
            ],
        ]);
    }

    public function deactivate(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'machine_id' => 'nullable|string|max:255',
        ]);

        $user = $request->api_user;

        $activationKey = ActivationKey::where('key', $data['key'])
            ->where('user_id', $user->id)
            ->first();

        if (! $activationKey) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid license key.',
                'code' => 'INVALID_KEY',
            ], 404);
        }

        $activationKey->events()->create([
            'event_type' => 'deactivated',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => [
                'domain' => $data['domain'] ?? null,
                'machine_id' => $data['machine_id'] ?? null,
            ],
        ]);

        return response()->json([
            'success' => true,
            'data' => ['deactivated' => true],
        ]);
    }

    public function info(Request $request, $key)
    {
        $user = $request->api_user;

        $activationKey = ActivationKey::where('key', $key)
            ->where('user_id', $user->id)
            ->withCount('events')
            ->first();

        if (! $activationKey) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid license key.',
                'code' => 'INVALID_KEY',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'key' => $activationKey->key,
                'status' => $activationKey->status,
                'valid' => $activationKey->isValid(),
                'client_name' => $activationKey->client_name,
                'client_email' => $activationKey->client_email,
                'domain' => $activationKey->domain,
                'product_type' => $activationKey->product_type,
                'activated_at' => $activationKey->activated_at?->toISOString(),
                'expires_at' => $activationKey->expires_at?->toISOString(),
                'last_validated_at' => $activationKey->last_validated_at?->toISOString(),
                'events_count' => $activationKey->events_count,
            ],
        ]);
    }
}
