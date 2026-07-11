<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::withCount('features')->orderBy('sort_order')->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly,lifetime',
            'max_keys' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'stripe_price_id' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*.name' => 'required|string|max:255',
            'features.*.description' => 'nullable|string|max:255',
            'features.*.icon' => 'nullable|string|max:100',
            'features.*.sort_order' => 'integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        $plan = Plan::create($data);

        if ($request->has('features')) {
            foreach ($request->input('features') as $featureData) {
                $plan->features()->create([
                    'name' => $featureData['name'],
                    'description' => $featureData['description'] ?? null,
                    'icon' => $featureData['icon'] ?? null,
                    'sort_order' => $featureData['sort_order'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        $plan->load('features');
        $featuresData = $plan->features->map(fn($f) => [
            'id' => $f->id,
            'name' => $f->name,
            'description' => $f->description ?? '',
            'icon' => $f->icon ?? '',
            'sort_order' => $f->sort_order,
            'is_active' => $f->is_active,
        ])->values();
        return view('admin.plans.edit', compact('plan', 'featuresData'));
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly,lifetime',
            'max_keys' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'stripe_price_id' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*.id' => 'nullable|integer|exists:plan_features,id',
            'features.*.name' => 'required|string|max:255',
            'features.*.description' => 'nullable|string|max:255',
            'features.*.icon' => 'nullable|string|max:100',
            'features.*.sort_order' => 'integer|min:0',
            'features.*.is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        $plan->update($data);

        $submittedIds = [];
        if ($request->has('features')) {
            foreach ($request->input('features') as $featureData) {
                if (!empty($featureData['id'])) {
                    $feature = PlanFeature::find($featureData['id']);
                    if ($feature && $feature->plan_id === $plan->id) {
                        $feature->update([
                            'name' => $featureData['name'],
                            'description' => $featureData['description'] ?? null,
                            'icon' => $featureData['icon'] ?? null,
                            'sort_order' => $featureData['sort_order'] ?? 0,
                            'is_active' => $featureData['is_active'] ?? true,
                        ]);
                        $submittedIds[] = $feature->id;
                    }
                } else {
                    $feature = $plan->features()->create([
                        'name' => $featureData['name'],
                        'description' => $featureData['description'] ?? null,
                        'icon' => $featureData['icon'] ?? null,
                        'sort_order' => $featureData['sort_order'] ?? 0,
                    ]);
                    $submittedIds[] = $feature->id;
                }
            }
        }

        $plan->features()->whereNotIn('id', $submittedIds)->delete();

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
