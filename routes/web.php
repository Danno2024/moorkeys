<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\ActivationKeyController as AdminActivationKeyController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\EmailTemplateController as AdminEmailTemplateController;
use App\Http\Controllers\Admin\InvoiceTemplateController as AdminInvoiceTemplateController;
use App\Http\Controllers\Admin\TwoFactorController as AdminTwoFactorController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\ActivationKeyController as ClientActivationKeyController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Install\InstallController;

// Installer routes (only available if not installed)
Route::middleware('install.check')->group(function () {
    Route::get('/install', [InstallController::class, 'index'])->name('install.welcome');
    Route::get('/install/requirements', [InstallController::class, 'requirements'])->name('install.requirements');
    Route::match(['get', 'post'], '/install/database', [InstallController::class, 'database'])->name('install.database');
    Route::match(['get', 'post'], '/install/admin', [InstallController::class, 'admin'])->name('install.admin');
    Route::match(['get', 'post'], '/install/seed', [InstallController::class, 'seed'])->name('install.seed');
    Route::get('/install/complete', [InstallController::class, 'complete'])->name('install.complete');
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/p/{slug}', [HomeController::class, 'page'])->name('page');

// Stripe webhook (CSRF exempt)
Route::post('stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->role === 'end_user') {
            return redirect()->route('customer.dashboard');
        }
        return redirect()->route('client.dashboard');
    })->name('dashboard');

    // 2FA routes
    Route::prefix('2fa')->name('2fa.')->group(function () {
        Route::get('/verify', [AdminTwoFactorController::class, 'showVerifyForm'])->name('verify');
        Route::post('/verify', [AdminTwoFactorController::class, 'verify']);
        Route::get('/recovery', [AdminTwoFactorController::class, 'showRecoveryForm'])->name('recovery');
        Route::post('/recovery', [AdminTwoFactorController::class, 'verifyRecovery'])->name('recovery.verify');
    });

    // Super Admin routes
    Route::middleware(['admin', 'two-factor'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::post('users/{user}/api-token', [AdminUserController::class, 'generateApiToken'])->name('users.api-token');

        Route::resource('plans', AdminPlanController::class)->except(['show']);

        Route::post('keys/bulk-create', [AdminActivationKeyController::class, 'bulkCreate'])->name('keys.bulk-create');
        Route::resource('keys', AdminActivationKeyController::class)->parameters([
            'keys' => 'activationKey',
        ]);

        Route::resource('pages', AdminPageController::class)->except(['show']);

        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::get('settings/maintenance', [AdminSettingController::class, 'maintenance'])->name('settings.maintenance');
        Route::post('settings/maintenance', [AdminSettingController::class, 'toggleMaintenance'])->name('settings.toggle-maintenance');
        Route::get('settings/reinstall', [AdminSettingController::class, 'reinstall'])->name('settings.reinstall');
        Route::post('settings/reinstall', [AdminSettingController::class, 'reinstallConfirm'])->name('settings.reinstall.confirm');

        Route::resource('email-templates', AdminEmailTemplateController::class)->except(['show']);
        Route::get('email-templates/{email_template}/preview', [AdminEmailTemplateController::class, 'preview'])->name('email-templates.preview');
        Route::resource('invoice-templates', AdminInvoiceTemplateController::class)->except(['show']);
        Route::get('invoice-templates/{invoice_template}/preview', [AdminInvoiceTemplateController::class, 'preview'])->name('invoice-templates.preview');
    });

    // Checkout routes
    Route::post('checkout/{plan}', [CheckoutController::class, 'session'])->name('checkout.session');
    Route::get('billing/portal', [CheckoutController::class, 'portal'])->name('billing.portal');

    // Public license lookup
Route::get('/l/{key}', [LicenseController::class, 'show'])->name('license.show');

// Customer portal (end-user registration)
Route::middleware('guest')->group(function () {
    Route::get('customer/register', [CustomerController::class, 'showRegisterForm'])->name('customer.register');
    Route::post('customer/register', [CustomerController::class, 'register']);
});

// Customer portal (authenticated end-user)
Route::middleware('auth')->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::post('/claim', [CustomerController::class, 'claim'])->name('claim');
    Route::delete('/keys/{activationKey}', [CustomerController::class, 'unclaim'])->name('unclaim');
});

// Client routes
    Route::middleware(['two-factor'])->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

        Route::get('keys/create', [ClientActivationKeyController::class, 'create'])->name('keys.create');
        Route::post('keys', [ClientActivationKeyController::class, 'store'])->name('keys.store');
        Route::get('keys', [ClientActivationKeyController::class, 'index'])->name('keys.index');
        Route::get('keys/{activationKey}', [ClientActivationKeyController::class, 'show'])->name('keys.show');
        Route::get('keys/{activationKey}/edit', [ClientActivationKeyController::class, 'edit'])->name('keys.edit');
        Route::put('keys/{activationKey}', [ClientActivationKeyController::class, 'update'])->name('keys.update');
        Route::post('keys/{activationKey}/revoke', [ClientActivationKeyController::class, 'revoke'])->name('keys.revoke');

        Route::get('profile', [ClientProfileController::class, 'show'])->name('profile');
        Route::post('profile', [ClientProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/api-token', [ClientProfileController::class, 'generateApiToken'])->name('profile.api-token');
        Route::get('password', [ClientProfileController::class, 'showPasswordForm'])->name('password');
        Route::post('password', [ClientProfileController::class, 'updatePassword'])->name('password.update');
    });
});

// Breeze auth routes
require __DIR__.'/auth.php';
