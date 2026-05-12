<?php

namespace App\Http\Controllers;

use App\Models\HardwareCategory;
use App\Models\HardwareItem;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HardwareItemController extends Controller
{
    public function index(Request $request): View
    {
        $query = HardwareItem::query()
            ->with('category')
            ->orderByDesc('id');

        $categoryId = $request->integer('category_id');
        if ($categoryId) {
            $query->where('hardware_category_id', $categoryId);
        }

        $items = $query->paginate(15)->withQueryString();

        $categories = HardwareCategory::query()->orderBy('name')->get();

        return view('hardware.items.index', compact('items', 'categories', 'categoryId'));
    }

    public function create(): View
    {
        $categories = HardwareCategory::query()->orderBy('name')->get();
        $users = User::query()->orderBy('email')->get();

        return view('hardware.items.create', compact('categories', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hardware_category_id' => ['required', 'integer', 'exists:hardware_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'asset_tag' => ['required', 'string', 'max:255', 'unique:hardware_items,asset_tag'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'assigned_to_user_id' => ['nullable', 'integer', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $item = HardwareItem::query()->create($validated);

        return redirect()->route('hardware.items.edit', $item);
    }

    public function edit(HardwareItem $item): View
    {
        $item->load('category');

        $categories = HardwareCategory::query()->orderBy('name')->get();
        $users = User::query()->orderBy('email')->get();

        return view('hardware.items.edit', compact('item', 'categories', 'users'));
    }

    public function update(Request $request, HardwareItem $item): RedirectResponse
    {
        $validated = $request->validate([
            'hardware_category_id' => ['required', 'integer', 'exists:hardware_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'asset_tag' => ['required', 'string', 'max:255', 'unique:hardware_items,asset_tag,'.$item->id],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'assigned_to_user_id' => ['nullable', 'integer', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $item->update($validated);

        return redirect()->route('hardware.items.edit', $item);
    }

    public function destroy(HardwareItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('hardware.items.index');
    }
}

