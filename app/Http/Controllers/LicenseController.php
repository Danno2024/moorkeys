<?php

namespace App\Http\Controllers;

use App\Models\ActivationKey;

class LicenseController extends Controller
{
    public function show(string $key)
    {
        $activationKey = ActivationKey::where('key', $key)
            ->with(['plan:id,name,description', 'user:id,name,email'])
            ->firstOrFail();

        return view('license.show', [
            'activationKey' => $activationKey,
        ]);
    }
}
