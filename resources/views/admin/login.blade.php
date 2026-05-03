<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Login - {{ config('app.name', 'Aldera Saddatech Karya') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
        <div class="grid min-h-screen place-items-center px-4">
            <div class="w-full max-w-md rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl shadow-cyan-950/20 backdrop-blur">
                <div class="mb-8 text-center">
                    <p class="font-display text-3xl font-bold text-white">Admin Login</p>
                    <p class="mt-2 text-sm text-slate-400">Masuk untuk mengubah konten website dan gambar.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-5 rounded-2xl border border-rose-400/20 bg-rose-400/10 px-4 py-3 text-sm text-rose-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-300">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none ring-0 placeholder:text-slate-500 focus:border-cyan-300/40"
                            placeholder="admin@aldera-saddatech.test"
                        >
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-300">Password</label>
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none ring-0 placeholder:text-slate-500 focus:border-cyan-300/40"
                            placeholder="••••••••"
                        >
                    </div>
                    <label class="flex items-center gap-2 text-sm text-slate-400">
                        <input type="checkbox" name="remember" value="1" class="rounded border-white/10 bg-slate-900/80">
                        Remember me
                    </label>
                    <button type="submit" class="w-full rounded-full bg-cyan-400 px-4 py-3 font-bold text-slate-950 transition hover:bg-cyan-300">
                        Masuk
                    </button>
                </form>

                <div class="mt-6 rounded-2xl border border-white/10 bg-slate-950/60 p-4 text-sm text-slate-400">
                    Demo login:
                    <div class="mt-2 text-slate-200">admin@aldera-saddatech.test</div>
                    <div class="text-slate-200">Admin12345!</div>
                </div>
            </div>
        </div>
    </body>
</html>
