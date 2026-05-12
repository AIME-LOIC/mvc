@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <h2 style="margin-top:0;">Edit Category</h2>

    @include('hardware.partials.errors')

    <form method="POST" action="{{ route('hardware.categories.update', $category) }}" style="max-width: 520px;">
        @csrf
        @method('PUT')

        <label style="display:block; margin-bottom: 12px;">
            Name
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                   style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
        </label>

        <label style="display:block; margin-bottom: 12px;">
            Slug
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" required
                   style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
        </label>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('hardware.categories.index') }}" style="padding:8px 10px; border:1px solid #e5e7eb; border-radius:10px; text-decoration:none; color:#111827;">Back</a>
            <button type="submit" style="padding:8px 10px; border:1px solid #111827; border-radius:10px; background:#111827; color:#fff;">Update</button>
        </div>
    </form>
@endsection

