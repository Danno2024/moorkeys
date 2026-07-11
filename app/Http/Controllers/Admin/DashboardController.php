<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\ActivationKey;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_keys' => ActivationKey::count(),
            'active_keys' => ActivationKey::where('status', 'active')->count(),
            'total_plans' => Plan::count(),
            'active_subscriptions' => Subscription::where('status', 'active')->count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_keys' => ActivationKey::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
