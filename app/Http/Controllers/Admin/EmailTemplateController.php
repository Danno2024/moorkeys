<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::orderBy('name')->get();
        return view('admin.email-templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.email-templates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:100|unique:email_templates,key',
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'variables' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data['variables'] = $request->filled('variables')
            ? array_map('trim', explode(',', $request->variables))
            : [];
        $data['is_active'] = $request->boolean('is_active', true);

        EmailTemplate::create($data);

        return redirect()->route('admin.email-templates.index')->with('success', 'Email template created successfully.');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.email-templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $data = $request->validate([
            'key' => 'required|string|max:100|unique:email_templates,key,' . $emailTemplate->id,
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'variables' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data['variables'] = $request->filled('variables')
            ? array_map('trim', explode(',', $request->variables))
            : [];
        $data['is_active'] = $request->boolean('is_active');

        $emailTemplate->update($data);

        return redirect()->route('admin.email-templates.index')->with('success', 'Email template updated successfully.');
    }

    public function preview(EmailTemplate $emailTemplate)
    {
        return view('admin.email-templates.preview', compact('emailTemplate'));
    }

    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        return redirect()->route('admin.email-templates.index')->with('success', 'Email template deleted successfully.');
    }
}
