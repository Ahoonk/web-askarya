@extends('admin.layout')

@section('content')
    <div class="space-y-6">
        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8">
            <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/80">Clients</p>
            <h1 class="mt-3 font-display text-4xl font-bold text-white">Edit client</h1>
        </div>

        <form method="POST" action="{{ route('admin.clients.update', $client) }}" enctype="multipart/form-data" class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
            @csrf
            @method('PUT')
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Name</label>
                        <input name="name" value="{{ old('name', $client->name) }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Sector</label>
                        <input name="sector" value="{{ old('sector', $client->sector) }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                    </div>
                    <div class="lg:col-span-2">
                        <label class="mb-2 block text-sm text-slate-300">Description</label>
                        <textarea name="description" rows="4" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('description', $client->description) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Sort order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $client->sort_order) }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                    </div>
                </div>

                <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/60 p-5">
                    <p class="font-display text-xl font-bold text-white">Media</p>
                    <p class="mt-2 text-sm text-slate-400">Ganti atau hapus gambar client dari sini.</p>

                    @if ($client->image_url)
                        <div class="mt-4 overflow-hidden rounded-2xl border border-white/10">
                            <img src="{{ $client->image_url }}" class="h-48 w-full object-cover" alt="{{ $client->name }}">
                        </div>
                        <label class="mt-4 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-200">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-white/10 bg-slate-950/80">
                            Hapus gambar saat ini
                        </label>
                    @else
                        <div class="mt-4 rounded-2xl border border-dashed border-white/10 bg-white/5 p-6 text-sm text-slate-400">
                            Belum ada gambar client.
                        </div>
                    @endif

                    <div class="mt-4">
                        <label class="mb-2 block text-sm text-slate-300">Upload / replace image</label>
                        <input type="file" name="image" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:font-bold file:text-slate-950">
                    </div>
                </div>
            </div>
            <div class="mt-5 flex gap-3">
                <button type="submit" class="rounded-full bg-cyan-400 px-6 py-3 font-bold text-slate-950 transition hover:bg-cyan-300">Update Client</button>
                <a href="{{ route('admin.clients.index') }}" class="rounded-full border border-white/10 px-6 py-3 font-semibold text-white transition hover:bg-white/5">Back</a>
            </div>
        </form>
    </div>
@endsection
