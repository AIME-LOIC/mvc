<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SOS Tech') }}</title>
    </head>
    <body style="margin:0; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;">
        <header style="padding: 16px; border-bottom: 1px solid #e5e7eb; background:#0b1220; color:#fff;">
            <div style="max-width: 980px; margin: 0 auto; display:flex; align-items:center; justify-content:space-between; gap:16px;">
                <div>
                    @yield('header')
                </div>
                <div>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" style="padding: 8px 10px; border: 1px solid rgba(255,255,255,.35); background: transparent; color:#fff; cursor:pointer;">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>

        <main style="padding: 20px 16px;">
            <div style="max-width: 980px; margin: 0 auto;">
                @yield('content')
            </div>
        </main>
    </body>
</html>
