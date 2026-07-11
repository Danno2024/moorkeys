<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@moorkeys.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);
        $admin->profile()->create([
            'company' => 'MoorKeys',
        ]);

        $client = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'is_active' => true,
        ]);
        $client->profile()->create([
            'company' => 'John\'s CMS',
            'website' => 'https://johnscms.com',
        ]);

        $freePlan = Plan::create([
            'name' => 'Free',
            'slug' => 'free',
            'description' => 'Get started with basic key management.',
            'price' => 0,
            'billing_period' => 'yearly',
            'max_keys' => 5,
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $freePlan->features()->createMany([
            ['name' => '5 Activation Keys', 'sort_order' => 1],
            ['name' => 'Basic Support', 'sort_order' => 2],
            ['name' => 'Web Products', 'sort_order' => 3],
        ]);

        $proPlan = Plan::create([
            'name' => 'Professional',
            'slug' => 'professional',
            'description' => 'For growing businesses with more needs.',
            'price' => 29,
            'billing_period' => 'monthly',
            'max_keys' => 50,
            'is_active' => true,
            'sort_order' => 2,
        ]);
        $proPlan->features()->createMany([
            ['name' => '50 Activation Keys', 'sort_order' => 1],
            ['name' => 'Priority Support', 'sort_order' => 2],
            ['name' => 'All Product Types', 'sort_order' => 3],
            ['name' => 'API Access', 'sort_order' => 4],
            ['name' => 'Key Validation API', 'sort_order' => 5],
        ]);

        $enterprisePlan = Plan::create([
            'name' => 'Enterprise',
            'slug' => 'enterprise',
            'description' => 'Unlimited keys for large organizations.',
            'price' => 99,
            'billing_period' => 'monthly',
            'max_keys' => 0,
            'is_active' => true,
            'sort_order' => 3,
        ]);
        $enterprisePlan->features()->createMany([
            ['name' => 'Unlimited Keys', 'sort_order' => 1],
            ['name' => '24/7 Support', 'sort_order' => 2],
            ['name' => 'All Product Types', 'sort_order' => 3],
            ['name' => 'API Access', 'sort_order' => 4],
            ['name' => 'Key Validation API', 'sort_order' => 5],
            ['name' => 'Custom Integrations', 'sort_order' => 6],
            ['name' => 'White Label Option', 'sort_order' => 7],
        ]);

        Setting::set('site_name', 'MoorKeys');
        Setting::set('site_description', 'Professional activation key management platform.');
        Setting::set('contact_email', 'hello@moorkeys.com');
        Setting::set('footer_text', 'Built with Laravel.');

        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => "Privacy Policy\n\nThis is the privacy policy for MoorKeys. Your privacy is important to us.",
            'meta_title' => 'Privacy Policy - MoorKeys',
            'meta_description' => 'Our privacy policy.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        Page::create([
            'title' => 'Terms of Service',
            'slug' => 'terms-of-service',
            'content' => "Terms of Service\n\nThese are the terms of service for using MoorKeys.",
            'meta_title' => 'Terms of Service - MoorKeys',
            'meta_description' => 'Our terms of service.',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }
}
