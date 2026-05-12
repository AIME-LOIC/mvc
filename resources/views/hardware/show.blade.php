@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <div style="display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
        <div>
            <h2 style="margin: 0 0 6px;">Category: {{ $categoryModel?->name ?? ucfirst($category) }}</h2>
            <p style="margin:0; color:#6b7280;">Pick an item to view details.</p>
        </div>
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <a href="{{ route('hardware.items.index', ['category_id' => $categoryModel?->id]) }}"
               style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">
                Manage Items
            </a>
            <a href="{{ route('hardware.dashboard') }}"
               style="padding:8px 10px; border:1px solid #111827; border-radius:10px; text-decoration:none; color:#fff; background:#111827;">
                Dashboard
            </a>
        </div>
    </div>

    @if (!empty($dbError))
        <div style="margin-top: 16px; padding: 12px; border: 1px solid #f59e0b; background: #fffbeb; color:#92400e;">
            {{ $dbError }}
        </div>
    @endif

    <div style="margin-top: 16px; display:grid; grid-template-columns: 320px 1fr; gap: 14px;">
        <div style="border:1px solid #e5e7eb; border-radius: 12px; overflow:hidden; background:#fff;">
            <div style="padding: 10px 12px; border-bottom:1px solid #e5e7eb; background:#f9fafb; font-weight:700;">
                Items
            </div>
            <div>
                @forelse ($items as $item)
                    <a href="{{ route('hardware.show', ['category' => $category, 'item_id' => $item->id]) }}"
                       style="display:block; padding: 10px 12px; border-bottom:1px solid #f3f4f6; text-decoration:none; color:#111827; @if((int)$item_id === (int)$item->id) background:#eef2ff; @endif">
                        <div style="font-weight:700;">{{ $item->asset_tag }}</div>
                        <div style="font-size:13px; color:#6b7280;">{{ $item->name }}</div>
                    </a>
                @empty
                    <div style="padding: 12px; color:#6b7280;">No items in this category yet.</div>
                @endforelse
            </div>
        </div>

        <div style="border:1px solid #e5e7eb; border-radius: 12px; padding: 12px; background:#fff;">
            @if (is_null($item_id))
                <p style="margin:0;">Please select a specific item to view details.</p>
            @elseif ($selectedItem)
                <h3 style="margin:0 0 10px;">{{ $selectedItem->name }}</h3>
                <div style="display:grid; grid-template-columns: 160px 1fr; gap: 8px 12px; font-size: 14px;">
                    <div style="color:#6b7280;">Asset Tag</div><div>{{ $selectedItem->asset_tag }}</div>
                    <div style="color:#6b7280;">Serial</div><div>{{ $selectedItem->serial_number ?? '—' }}</div>
                    <div style="color:#6b7280;">Status</div><div>{{ $selectedItem->status }}</div>
                    <div style="color:#6b7280;">Location</div><div>{{ $selectedItem->location ?? '—' }}</div>
                    <div style="color:#6b7280;">Assigned To</div><div>{{ $selectedItem->assignedTo?->email ?? 'Unassigned' }}</div>
                </div>
                @if (!empty($selectedItem->notes))
                    <div style="margin-top: 10px; color:#374151;">
                        <div style="font-weight:700; margin-bottom:4px;">Notes</div>
                        <div style="white-space: pre-wrap;">{{ $selectedItem->notes }}</div>
                    </div>
                @endif

                <div style="margin-top: 12px;">
                    <a href="{{ route('hardware.items.edit', $selectedItem) }}"
                       style="display:inline-block; padding:8px 10px; border:1px solid #111827; border-radius:10px; text-decoration:none; color:#fff; background:#111827;">
                        Edit Item
                    </a>
                </div>
            @else
                <p style="margin:0;">Item not found in this category.</p>
            @endif
        </div>
    </div>

@endsection
