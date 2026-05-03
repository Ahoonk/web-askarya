<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Aldera Saddatech Karya') }} - Admin</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <style>[x-cloak]{display:none !important;}</style>
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
        <div class="min-h-screen lg:flex">
            <aside class="border-b border-white/10 bg-slate-950/95 px-6 py-6 lg:min-h-screen lg:w-80 lg:border-b-0 lg:border-r">
                <div class="flex items-center gap-3">
                    <div class="grid h-11 w-11 place-items-center rounded-2xl bg-cyan-400/15 ring-1 ring-cyan-300/30">
                        <span class="font-display text-lg font-bold tracking-tight text-cyan-200">NT</span>
                    </div>
                    <div>
                        <p class="font-display text-base font-bold tracking-tight text-white">Aldera Saddatech Karya</p>
                        <p class="text-xs text-slate-400">Admin Panel</p>
                    </div>
                </div>

                <nav class="mt-8 space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5">Dashboard</a>
                    <a href="{{ route('admin.settings.edit') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5">Settings</a>
                    <a href="{{ route('admin.clients.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5">Clients</a>
                    <a href="{{ route('admin.products.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5">Products</a>
                </nav>

                <div class="mt-8 rounded-3xl border border-white/10 bg-white/5 p-5">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Logged in as</p>
                    <p class="mt-3 font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-sm text-slate-400">{{ auth()->user()->email ?? '' }}</p>

                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full rounded-full bg-cyan-400 px-4 py-2 text-sm font-bold text-slate-950 transition hover:bg-cyan-300">
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-400/20 bg-rose-400/10 px-4 py-3 text-sm text-rose-100">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </body>
</html>
