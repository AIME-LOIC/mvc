@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <h2 style="margin-top:0;">Edit Item</h2>

    @include('hardware.partials.errors')

    <form method="POST" action="{{ route('hardware.items.update', $item) }}" style="max-width: 720px;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 12px;">
            <label>
                Category
                <select name="hardware_category_id" required style="display:block; width:100%; padding: 8px; border: 1px solid #d1d5db;">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('hardware_category_id', $item->hardware_category_id) === (int) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Status
                <select name="status" required style="display:block; width:100%; padding: 8px; border: 1px solid #d1d5db;">
                    @foreach (['available','assigned','repair','retired'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $item->status) === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </label>

            <label style="grid-column: 1 / -1;">
                Name
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required
                       style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
            </label>

            <label>
                Asset Tag
                <input type="text" name="asset_tag" value="{{ old('asset_tag', $item->asset_tag) }}" required
                       style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
            </label>

            <label>
                Serial Number
                <input type="text" name="serial_number" value="{{ old('serial_number', $item->serial_number) }}"
                       style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
            </label>

            <label>
                Location
                <input type="text" name="location" value="{{ old('location', $item->location) }}"
                       style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
            </label>

            <label>
                Assigned To (optional)
                <select name="assigned_to_user_id" style="display:block; width:100%; padding: 8px; border: 1px solid #d1d5db;">
                    <option value="">Unassigned</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected((int) old('assigned_to_user_id', $item->assigned_to_user_id) === (int) $user->id)>
                            {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label style="grid-column: 1 / -1;">
                Notes
                <textarea name="notes" rows="4" style="display:block; width:100%; padding: 8px; border: 1px solid #d1d5db;">{{ old('notes', $item->notes) }}</textarea>
            </label>
        </div>

        <div style="margin-top: 12px; display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('hardware.items.index') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Back</a>
            <button type="submit" style="padding:8px 10px; border:1px solid #111827; border-radius:10px; background:#111827; color:#fff;">Update</button>
        </div>
    </form>
@endsection

