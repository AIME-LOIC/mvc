@extends('layouts.master')

@section('header')
    <h1 style="margin: 0;">SOS Tech Equipment Tracker</h1>
@endsection

@section('content')
    <h2 style="margin-top: 0;">Staff Login</h2>

    @if ($errors->any())
        <div style="padding: 12px; border: 1px solid #ef4444; background: #fef2f2; margin-bottom: 12px;">
            <strong>Login failed</strong>
            <ul style="margin: 8px 0 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" style="max-width: 420px;">
        @csrf

        <label style="display:block; margin-bottom: 8px;">
            Email
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
        </label>

        <label style="display:block; margin-bottom: 12px;">
            Password
            <input type="password" name="password" required
                   style="display:block; width: 100%; padding: 8px; border: 1px solid #d1d5db;">
        </label>

        <button type="submit"
                style="padding: 8px 12px; border: 1px solid #111827; background: #111827; color: #fff;">
            Sign in
        </button>
    </form>
@endsection
