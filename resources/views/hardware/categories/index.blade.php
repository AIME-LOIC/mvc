@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <h2 style="margin:0;">Categories</h2>
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <a href="{{ route('hardware.dashboard') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Dashboard</a>
            <a href="{{ route('hardware.categories.create') }}" style="padding:8px 10px; border:1px solid #111827; border-radius:10px; text-decoration:none; color:#fff; background:#111827;">Add Category</a>
        </div>
    </div>

    <div style="margin-top: 14px; border: 1px solid #e5e7eb; border-radius: 12px; overflow:hidden;">
        <table style="width:100%; border-collapse: collapse;">
            <thead style="background:#f9fafb;">
                <tr>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Name</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Slug</th>
                    <th style="text-align:right; padding:10px; border-bottom:1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6;">{{ $category->name }}</td>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6; color:#6b7280;">{{ $category->slug }}</td>
                        <td style="padding:10px; border-bottom:1px solid #f3f4f6; text-align:right; white-space:nowrap;">
                            <a href="{{ route('hardware.categories.edit', $category) }}" style="text-decoration:none; margin-right:10px;">Edit</a>
                            <form method="POST" action="{{ route('hardware.categories.destroy', $category) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:transparent; color:#b91c1c; cursor:pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:12px; color:#6b7280;">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

