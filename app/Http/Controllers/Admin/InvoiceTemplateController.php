<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoiceTemplate;
use Illuminate\Http\Request;

class InvoiceTemplateController extends Controller
{
    public function index()
    {
        $templates = InvoiceTemplate::orderBy('name')->get();
        return view('admin.invoice-templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.invoice-templates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'logo_position' => 'required|in:left,center,right',
            'footer_text' => 'nullable|string|max:1000',
            'terms' => 'nullable|string|max:5000',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($data['is_default']) {
            InvoiceTemplate::where('is_default', true)->update(['is_default' => false]);
        }

        InvoiceTemplate::create($data);

        return redirect()->route('admin.invoice-templates.index')->with('success', 'Invoice template created successfully.');
    }

    public function edit(InvoiceTemplate $invoiceTemplate)
    {
        return view('admin.invoice-templates.edit', compact('invoiceTemplate'));
    }

    public function update(Request $request, InvoiceTemplate $invoiceTemplate)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'logo_position' => 'required|in:left,center,right',
            'footer_text' => 'nullable|string|max:1000',
            'terms' => 'nullable|string|max:5000',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        if ($data['is_default']) {
            InvoiceTemplate::where('id', '!=', $invoiceTemplate->id)->where('is_default', true)->update(['is_default' => false]);
        }

        $invoiceTemplate->update($data);

        return redirect()->route('admin.invoice-templates.index')->with('success', 'Invoice template updated successfully.');
    }

    public function preview(InvoiceTemplate $invoiceTemplate)
    {
        return view('admin.invoice-templates.preview', compact('invoiceTemplate'));
    }

    public function destroy(InvoiceTemplate $invoiceTemplate)
    {
        $invoiceTemplate->delete();
        return redirect()->route('admin.invoice-templates.index')->with('success', 'Invoice template deleted successfully.');
    }
}
