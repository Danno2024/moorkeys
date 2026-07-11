<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'key' => 'welcome',
                'name' => 'Welcome Email',
                'subject' => 'Welcome to {{app_name}}!',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{app_name}}</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <h1 style="color: #1e293b; margin: 0 0 8px;">Welcome to {{app_name}}!</h1>
            <p style="color: #64748b; margin: 0;">Your account has been created successfully</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">Thank you for joining {{app_name}}! We're excited to have you on board.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">Your Account Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Name:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{name}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Email:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{email}}</td></tr>
            </table>
        </div>

        <p style="font-size: 16px; color: #334155;">You can now log in to your dashboard and start managing your software licenses.</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{login_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">Access Your Dashboard</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If you have any questions, feel free to reach out to our support team.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'email', 'app_name', 'login_url'],
                'is_active' => true,
            ],
            [
                'key' => 'license_activated',
                'name' => 'License Activated',
                'subject' => 'Your License Has Been Activated - {{product_name}}',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Activated</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: #dcfce7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <h1 style="color: #1e293b; margin: 0 0 8px;">License Activated</h1>
            <p style="color: #64748b; margin: 0;">Your {{product_name}} license is now active</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">Great news! Your license for <strong>{{product_name}}</strong> has been successfully activated.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">License Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Product:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{product_name}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">License Key:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b; font-family: monospace;">{{license_key}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Activated On:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{activated_at}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Expires On:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{expires_at}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Activations Used:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{activations_used}}/{{max_activations}}</td></tr>
            </table>
        </div>

        <p style="font-size: 16px; color: #334155;">You can now use {{product_name}} with full access to all features.</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{dashboard_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">View License Dashboard</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If you didn't activate this license, please contact our support team immediately.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'product_name', 'license_key', 'activated_at', 'expires_at', 'activations_used', 'max_activations', 'dashboard_url', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'license_expired',
                'name' => 'License Expired',
                'subject' => 'Your {{product_name}} License Has Expired',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Expired</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: #fef2f2; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <h1 style="color: #1e293b; margin: 0 0 8px;">License Expired</h1>
            <p style="color: #64748b; margin: 0;">Your {{product_name}} license has expired</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">We wanted to let you know that your license for <strong>{{product_name}}</strong> expired on <strong>{{expired_at}}</strong>.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">Expired License Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Product:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{product_name}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">License Key:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b; font-family: monospace;">{{license_key}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Expired On:</td><td style="padding: 8px 0; font-weight: 600; color: #ef4444;">{{expired_at}}</td></tr>
            </table>
        </div>

        <p style="font-size: 16px; color: #334155;">To continue using {{product_name}} without interruption, please renew your license.</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{renewal_url}}" style="display: inline-block; background: #ef4444; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">Renew Your License</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If you believe this is an error or have already renewed, please contact our support team.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'product_name', 'license_key', 'expired_at', 'renewal_url', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'license_expiring_soon',
                'name' => 'License Expiring Soon (Reminder)',
                'subject' => 'Your {{product_name}} License Expires Soon - {{days_left}} Days Left',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Expiring Soon</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: #fef3c7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <h1 style="color: #1e293b; margin: 0 0 8px;">License Expiring Soon</h1>
            <p style="color: #64748b; margin: 0;">{{days_left}} days remaining</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">This is a friendly reminder that your license for <strong>{{product_name}}</strong> will expire in <strong>{{days_left}} days</strong> on <strong>{{expires_at}}</strong>.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">License Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Product:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{product_name}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">License Key:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b; font-family: monospace;">{{license_key}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Expires On:</td><td style="padding: 8px 0; font-weight: 600; color: #f59e0b;">{{expires_at}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Days Remaining:</td><td style="padding: 8px 0; font-weight: 600; color: #f59e0b;">{{days_left}}</td></tr>
            </table>
        </div>

        <p style="font-size: 16px; color: #334155;">Renew now to avoid any interruption to your service.</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{renewal_url}}" style="display: inline-block; background: #f59e0b; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">Renew Now</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">You can also renew from your <a href="{{dashboard_url}}" style="color: #4f46e5;">license dashboard</a>.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'product_name', 'license_key', 'expires_at', 'days_left', 'renewal_url', 'dashboard_url', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'license_renewed',
                'name' => 'License Renewed',
                'subject' => 'Your {{product_name}} License Has Been Renewed',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Renewed</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: #dcfce7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <h1 style="color: #1e293b; margin: 0 0 8px;">License Renewed</h1>
            <p style="color: #64748b; margin: 0;">Your {{product_name}} license is active for another period</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">Your license for <strong>{{product_name}}</strong> has been successfully renewed! Thank you for continuing with us.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">Renewal Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Product:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{product_name}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">License Key:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b; font-family: monospace;">{{license_key}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">New Expiry Date:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{new_expires_at}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Renewal Date:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{renewed_at}}</td></tr>
            </table>
        </div>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{dashboard_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">View License Dashboard</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If you have any questions about your renewal, please don't hesitate to reach out.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'product_name', 'license_key', 'new_expires_at', 'renewed_at', 'dashboard_url', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'activation_limit_reached',
                'name' => 'Activation Limit Reached',
                'subject' => 'Activation Limit Reached for {{product_name}}',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation Limit Reached</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: #fef2f2; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <h1 style="color: #1e293b; margin: 0 0 8px;">Activation Limit Reached</h1>
            <p style="color: #64748b; margin: 0;">Your {{product_name}} license cannot activate more devices</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">We detected an attempt to activate <strong>{{product_name}}</strong> but your license has reached its maximum number of allowed activations ({{max_activations}}).</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">Current Activations</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Current Activations:</td><td style="padding: 8px 0; font-weight: 600; color: #ef4444;">{{activations_used}}/{{max_activations}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">License Key:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b; font-family: monospace;">{{license_key}}</td></tr>
            </table>
        </div>

        <p style="font-size: 16px; color: #334155;">To activate on a new device, you'll need to deactivate an existing one first.</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{dashboard_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">Manage Activations</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If you believe this is an error or need assistance, please contact our support team.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'product_name', 'license_key', 'activations_used', 'max_activations', 'dashboard_url', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'password_reset',
                'name' => 'Password Reset',
                'subject' => 'Reset Your {{app_name}} Password',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <h1 style="color: #1e293b; margin: 0 0 8px;">Reset Your Password</h1>
            <p style="color: #64748b; margin: 0;">We received a request to reset your password</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">You requested to reset your password for your {{app_name}} account. Click the button below to create a new password:</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{reset_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">Reset Password</a>
        </div>

        <p style="font-size: 14px; color: #64748b;">This link will expire in {{expires_in}} minutes for security reasons.</p>

        <p style="font-size: 14px; color: #64748b;">If you didn't request this, you can safely ignore this email. Your password won't be changed.</p>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If the button doesn't work, copy and paste this link into your browser:<br><a href="{{reset_url}}" style="color: #4f46e5; word-break: break-all;">{{reset_url}}</a></p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'reset_url', 'expires_in', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'invoice_created',
                'name' => 'Invoice Created',
                'subject' => 'New Invoice {{invoice_number}} from {{app_name}}',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Invoice</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <h1 style="color: #1e293b; margin: 0 0 8px;">New Invoice</h1>
            <p style="color: #64748b; margin: 0;">Invoice {{invoice_number}} for {{amount}}</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">A new invoice has been generated for your account.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">Invoice Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Invoice Number:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{invoice_number}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Date:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{invoice_date}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Due Date:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{due_date}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Amount:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b; font-size: 18px;">{{amount}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Status:</td><td style="padding: 8px 0;"><span style="background: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600;">{{status}}</span></td></tr>
            </table>
        </div>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{invoice_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">View & Pay Invoice</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">If you have any questions about this invoice, please contact our billing department.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'invoice_number', 'invoice_date', 'due_date', 'amount', 'status', 'invoice_url', 'app_name'],
                'is_active' => true,
            ],
            [
                'key' => 'subscription_cancelled',
                'name' => 'Subscription Cancelled',
                'subject' => 'Your {{plan_name}} Subscription Has Been Cancelled',
                'body' => <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Cancelled</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8fafc; border-radius: 8px; padding: 40px; border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: #fef2f2; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            </div>
            <h1 style="color: #1e293b; margin: 0 0 8px;">Subscription Cancelled</h1>
            <p style="color: #64748b; margin: 0;">Your {{plan_name}} subscription has ended</p>
        </div>

        <p style="font-size: 16px; color: #334155;">Hi {{name}},</p>

        <p style="font-size: 16px; color: #334155;">We're sorry to see you go. Your subscription to <strong>{{plan_name}}</strong> has been cancelled as requested.</p>

        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 24px; margin: 24px 0;">
            <h3 style="color: #1e293b; margin: 0 0 16px; font-size: 18px;">Subscription Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 8px 0; color: #64748b;">Plan:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{plan_name}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Cancelled On:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{cancelled_at}}</td></tr>
                <tr><td style="padding: 8px 0; color: #64748b;">Access Until:</td><td style="padding: 8px 0; font-weight: 600; color: #1e293b;">{{access_until}}</td></tr>
            </table>
        </div>

        <p style="font-size: 16px; color: #334155;">You'll continue to have access until <strong>{{access_until}}</strong>. After that, your subscription features will be disabled.</p>

        <p style="font-size: 16px; color: #334155;">If you change your mind, you can always resubscribe from your account dashboard.</p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{resubscribe_url}}" style="display: inline-block; background: #4f46e5; color: #fff; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;">Resubscribe</a>
        </div>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

        <p style="font-size: 14px; color: #64748b; margin: 0;">We'd love to hear your feedback on why you cancelled. <a href="{{feedback_url}}" style="color: #4f46e5;">Let us know</a>.</p>

        <p style="font-size: 14px; color: #64748b; margin: 16px 0 0;">Best regards,<br>The {{app_name}} Team</p>
    </div>
</body>
</html>
HTML,
                'variables' => ['name', 'plan_name', 'cancelled_at', 'access_until', 'resubscribe_url', 'feedback_url', 'app_name'],
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            EmailTemplate::updateOrCreate(
                ['key' => $template['key']],
                $template
            );
        }
    }
}