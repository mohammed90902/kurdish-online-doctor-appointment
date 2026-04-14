<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpecializationManagementController extends Controller
{
    public function index()
    {
        $specializations = Specialization::withCount('doctors')->get();
        return view('admin.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ku' => 'required|string|max:255|unique:specializations,name_ku',
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_ku' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('specializations', 'public');
            $validated['image'] = $path;
        }

        Specialization::create($validated);

        return redirect()->route('admin.specializations.index')->with('success', 'بەشەکە بە سەرکەوتوویی زیادکرا.');
    }

    public function edit($id)
    {
        $specialization = Specialization::findOrFail($id);
        return view('admin.specializations.edit', compact('specialization'));
    }

    public function update(Request $request, $id)
    {
        $specialization = Specialization::findOrFail($id);

        $validated = $request->validate([
            'name_ku' => 'required|string|max:255|unique:specializations,name_ku,' . $id,
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_ku' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($specialization->image) {
                Storage::disk('public')->delete($specialization->image);
            }
            $path = $request->file('image')->store('specializations', 'public');
            $validated['image'] = $path;
        }

        $specialization->update($validated);

        return redirect()->route('admin.specializations.index')->with('success', 'بەشەکە بە سەرکەوتوویی نوێکرایەوە.');
    }

    public function destroy($id)
    {
        $specialization = Specialization::findOrFail($id);
        
        // Check if there are doctors linked
        if ($specialization->doctors()->count() > 0) {
            return back()->with('error', 'ناتوانیت ئەم بەشە بسڕیتەوە چونکە پزیشکی تێدایە.');
        }

        if ($specialization->image) {
            Storage::disk('public')->delete($specialization->image);
        }

        $specialization->delete();

        return redirect()->route('admin.specializations.index')->with('success', 'بەشەکە بە سەرکەوتوویی سڕایەوە.');
    }
}
