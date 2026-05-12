@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <div style="display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
        <div>
            <h2 style="margin: 0 0 6px;">Hardware Dashboard</h2>
            <p style="margin:0; color:#4b5563;">Select a category from your inventory list to view items.</p>
        </div>
        <div style="color:#6b7280; font-size: 14px;">
            Signed in as: <strong style="color:#111827;">{{ auth()->user()->email }}</strong>
        </div>
    </div>

    <div style="margin-top: 14px; display:flex; gap:8px; flex-wrap:wrap;">
        <a href="{{ route('hardware.categories.index') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Manage Categories</a>
        <a href="{{ route('hardware.items.index') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Manage Items</a>
    </div>

    @if (!empty($dbError))
        <div style="margin-top: 16px; padding: 12px; border: 1px solid #f59e0b; background: #fffbeb; color:#92400e;">
            {{ $dbError }}
        </div>
    @endif

    <div style="margin-top: 18px; display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px;">
        @forelse ($categories as $category)
            <a href="{{ route('hardware.show', ['category' => $category->slug]) }}"
               style="display:block; padding: 14px; border: 1px solid #e5e7eb; border-radius: 10px; text-decoration:none; color:#111827; background:#fff;">
                <div style="font-weight: 700; margin-bottom: 6px;">{{ $category->name }}</div>
                <div style="font-size: 13px; color:#6b7280;">View items in {{ $category->slug }}</div>
            </a>
        @empty
            <div style="padding: 14px; border: 1px dashed #d1d5db; border-radius: 10px; color:#6b7280;">
                No categories yet. Seed the database, then refresh.
            </div>
        @endforelse
    </div>
@endsection
