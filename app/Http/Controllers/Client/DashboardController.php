<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $stats = [
            'total_keys' => $user->activationKeys()->count(),
            'active_keys' => $user->activationKeys()->where('status', 'active')->count(),
            'subscription' => $user->activeSubscription()->with('plan')->first(),
        ];
        $recentKeys = $user->activationKeys()->latest()->take(5)->get();
        return view('client.dashboard', compact('stats', 'recentKeys'));
    }
}
