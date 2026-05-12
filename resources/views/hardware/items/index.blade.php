@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <h2 style="margin:0;">Items</h2>
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <a href="{{ route('hardware.dashboard') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Dashboard</a>
            <a href="{{ route('hardware.items.create') }}" style="padding:8px 10px; border:1px solid #111827; border-radius:10px; text-decoration:none; color:#fff; background:#111827;">Add Item</a>
        </div>
    </div>

    <form method="GET" action="{{ route('hardware.items.index') }}" style="margin-top: 12px; display:flex; gap:8px; flex-wrap:wrap; align-items:end;">
        <label>
            Category
            <select name="category_id" style="display:block; padding: 8px; border: 1px solid #d1d5db; min-width: 220px;">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((int) $categoryId === (int) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </label>
        <button type="submit" style="padding:8px 10px; border:1px solid #111827; border-radius:10px; background:#111827; color:#fff;">Filter</button>
        <a href="{{ route('hardware.items.index') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Reset</a>
    </form>

    <div style="margin-top: 14px; border: 1px solid #e5e7eb; border-radius: 12px; overflow:hidden;">
        <table style="width:100%; border-collapse: collapse;">
            <thead style="background:#f9fafb;">
                <tr>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Asset Tag</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Name</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Category</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Status</th>
                    <th style="text-align:right; padding:10px; border-bottom:1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6;">{{ $item->asset_tag }}</td>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6;">{{ $item->name }}</td>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6; color:#6b7280;">{{ $item->category?->name }}</td>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6; color:#6b7280;">{{ $item->status }}</td>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6; text-align:right; white-space:nowrap;">
                            <a href="{{ route('hardware.items.edit', $item) }}" style="text-decoration:none; margin-right:10px;">Edit</a>
                            <form method="POST" action="{{ route('hardware.items.destroy', $item) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:transparent; color:#b91c1c; cursor:pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:12px; color:#6b7280;">No items yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 12px;">
        {{ $items->links() }}
    </div>
@endsection

