@extends('admin.layout')

@section('content')
    <div class="space-y-8">
        <section class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl shadow-slate-950/20">
            <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/80">Dashboard</p>
            <h1 class="mt-3 font-display text-4xl font-bold text-white">Kelola konten website dari satu tempat.</h1>
            <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-300">
                Gunakan panel ini untuk memperbarui teks company profile, visi misi, client, produk, dan gambar yang tampil di homepage.
            </p>
        </section>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                <p class="text-sm text-slate-400">Company name</p>
                <p class="mt-3 font-display text-2xl font-bold text-white">{{ $setting->company_name ?? 'Aldera Saddatech Karya' }}</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                <p class="text-sm text-slate-400">Total Clients</p>
                <p class="mt-3 font-display text-4xl font-bold text-white">{{ $clientCount }}</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                <p class="text-sm text-slate-400">Total Products</p>
                <p class="mt-3 font-display text-4xl font-bold text-white">{{ $productCount }}</p>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-3">
            <a href="{{ route('admin.settings.edit') }}" class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6 transition hover:border-cyan-300/30 hover:bg-slate-900/90">
                <p class="font-display text-2xl font-bold text-white">Settings</p>
                <p class="mt-3 text-sm leading-7 text-slate-300">Atur hero, profil, visi misi, about us, dan gambar utama.</p>
            </a>
            <a href="{{ route('admin.clients.index') }}" class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6 transition hover:border-cyan-300/30 hover:bg-slate-900/90">
                <p class="font-display text-2xl font-bold text-white">Clients</p>
                <p class="mt-3 text-sm leading-7 text-slate-300">Tambah, ubah, dan hapus client beserta gambarnya.</p>
            </a>
            <a href="{{ route('admin.products.index') }}" class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6 transition hover:border-cyan-300/30 hover:bg-slate-900/90">
                <p class="font-display text-2xl font-bold text-white">Products</p>
                <p class="mt-3 text-sm leading-7 text-slate-300">Kelola produk dan fitur yang ditampilkan di homepage.</p>
            </a>
        </div>
    </div>
@endsection
