@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <h2 style="margin-top: 0;">Category: {{ $category }}</h2>

    @if (is_null($item_id))
        <p>Please select a specific item to view details.</p>
    @else
        <p>Item ID: {{ $item_id }}</p>
    @endif

    <a href="{{ route('hardware.dashboard') }}"
       style="display: inline-block; margin-top: 12px; padding: 8px 12px; border: 1px solid #111827; text-decoration: none;">
        Back to Hardware Dashboard
    </a>
@endsection

