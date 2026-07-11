<?php

namespace App\Services;

use Illuminate\Support\Str;

class KeyGeneratorService
{
    public function generate(): string
    {
        $prefix = 'MK-';
        $segments = [];
        for ($i = 0; $i < 4; $i++) {
            $segments[] = strtoupper(Str::random(4));
        }
        return $prefix . implode('-', $segments);
    }

    public function validateKey(string $key): bool
    {
        return (bool) preg_match('/^MK-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}$/', $key);
    }
}
