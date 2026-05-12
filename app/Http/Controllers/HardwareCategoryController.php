<?php

namespace App\Http\Controllers;

use App\Models\HardwareCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HardwareCategoryController extends Controller
{
    public function index(): View
    {
        $categories = HardwareCategory::query()
            ->orderBy('name')
            ->get();

        return view('hardware.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('hardware.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $slug = Str::slug($validated['name']);

        $category = HardwareCategory::query()->create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('hardware.categories.edit', $category);
    }

    public function edit(HardwareCategory $category): View
    {
        return view('hardware.categories.edit', compact('category'));
    }

    public function update(Request $request, HardwareCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:hardware_categories,slug,'.$category->id],
        ]);

        $category->update($validated);

        return redirect()->route('hardware.categories.edit', $category);
    }

    public function destroy(HardwareCategory $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('hardware.categories.index');
    }
}

