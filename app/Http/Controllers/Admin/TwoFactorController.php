<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.two-factor-verify');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|string|size:6']);

        $user = $request->user();

        $google2fa = app('pragmarx.google2fa');

        $valid = $google2fa->verifyKey($user->two_factor_secret, $request->code);

        if ($valid) {
            session(['two_factor_authenticated' => true]);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    public function showRecoveryForm()
    {
        return view('auth.two-factor-recovery');
    }

    public function verifyRecovery(Request $request)
    {
        $request->validate(['recovery_code' => 'required|string']);

        $user = $request->user();
        $codes = json_decode($user->two_factor_recovery_codes, true) ?? [];

        $index = array_search($request->recovery_code, $codes);

        if ($index !== false) {
            unset($codes[$index]);
            $user->update(['two_factor_recovery_codes' => json_encode(array_values($codes))]);
            session(['two_factor_authenticated' => true]);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['recovery_code' => 'Invalid recovery code.']);
    }
}
