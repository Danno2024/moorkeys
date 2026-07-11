<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstallController extends Controller
{
    public function index()
    {
        if ($this->isInstalled()) {
            return view('install.already-installed');
        }
        return view('install.welcome');
    }

    public function requirements()
    {
        if ($this->isInstalled()) {
            return view('install.already-installed');
        }

        $requirements = [
            'PHP Version (>= 8.1)' => version_compare(PHP_VERSION, '8.1.0', '>='),
            'PDO Extension' => extension_loaded('pdo'),
            'PDO MySQL Extension' => extension_loaded('pdo_mysql'),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'Mbstring Extension' => extension_loaded('mbstring'),
            'Tokenizer Extension' => extension_loaded('tokenizer'),
            'XML Extension' => extension_loaded('xml'),
            'Ctype Extension' => extension_loaded('ctype'),
            'JSON Extension' => extension_loaded('json'),
            'BCMath Extension' => extension_loaded('bcmath'),
            'Fileinfo Extension' => extension_loaded('fileinfo'),
            'Storage Writable' => is_writable(storage_path()),
            'Bootstrap Cache Writable' => is_writable(storage_path('framework/cache')),
            '.env Writable' => is_writable(base_path('.env')),
        ];

        return view('install.requirements', compact('requirements'));
    }

    public function database(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'db_host' => 'required|string',
                'db_port' => 'required|integer',
                'db_database' => 'required|string',
                'db_username' => 'required|string',
                'db_password' => 'nullable|string',
            ]);

            $config = [
                'DB_CONNECTION' => 'mysql',
                'DB_HOST' => $request->db_host,
                'DB_PORT' => $request->db_port,
                'DB_DATABASE' => $request->db_database,
                'DB_USERNAME' => $request->db_username,
                'DB_PASSWORD' => $request->db_password,
            ];

            if ($this->testConnection($config)) {
                $this->updateEnv($config);
                return redirect()->route('install.admin')->with('success', 'Database connection successful!');
            }

            return back()->withErrors(['db_connection' => 'Could not connect to database. Please check your credentials.']);
        }

        return view('install.database');
    }

    public function admin(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            session([
                'admin_data' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            return redirect()->route('install.seed');
        }

        return view('install.admin');
    }

    public function seed(Request $request)
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        if ($request->isMethod('post')) {
            $withDemo = $request->boolean('with_demo');

            try {
                Artisan::call('migrate', ['--force' => true]);

                if ($withDemo) {
                    Artisan::call('db:seed', ['--force' => true]);
                } else {
                    Artisan::call('db:seed', ['--class' => 'AdminUserSeeder', '--force' => true]);
                }

                $adminData = session('admin_data');
                if ($adminData) {
                    $this->createAdminUser($adminData);
                }

                $this->markInstalled();

                return redirect()->route('install.complete')->with('success', 'Installation complete!');
            } catch (\Exception $e) {
                return back()->withErrors(['install' => 'Installation failed: ' . $e->getMessage()]);
            }
        }

        return view('install.seed');
    }

    public function complete()
    {
        if (!$this->isInstalled()) {
            return redirect()->route('install.welcome');
        }
        return view('install.complete');
    }

    private function isInstalled(): bool
    {
        return File::exists(storage_path('installed'));
    }

    private function markInstalled(): void
    {
        File::put(storage_path('installed'), now()->toISOString());
    }

    private function testConnection(array $config): bool
    {
        try {
            $pdo = new \PDO(
                "mysql:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname={$config['DB_DATABASE']}",
                $config['DB_USERNAME'],
                $config['DB_PASSWORD'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    private function updateEnv(array $config): void
    {
        $envPath = base_path('.env');
        $env = File::get($envPath);

        foreach ($config as $key => $value) {
            $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
        }

        if (!Str::contains($env, 'APP_KEY=')) {
            $env = Str::replace('APP_KEY=', 'APP_KEY=' . Str::random(32), $env);
        }

        File::put($envPath, $env);
    }

    private function createAdminUser(array $data): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );
    }
}