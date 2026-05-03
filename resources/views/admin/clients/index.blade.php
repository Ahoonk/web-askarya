@extends('admin.layout')

@section('content')
    <div class="space-y-6">
        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8">
            <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/80">Clients</p>
            <h1 class="mt-3 font-display text-4xl font-bold text-white">Tambah client baru</h1>
        </div>

        <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data" class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
            @csrf
            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm text-slate-300">Name</label>
                    <input name="name" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-300">Sector</label>
                    <input name="sector" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm text-slate-300">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white"></textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-300">Sort order</label>
                    <input type="number" name="sort_order" value="0" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-300">Image</label>
                    <input type="file" name="image" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:font-bold file:text-slate-950">
                </div>
            </div>
            <button type="submit" class="mt-5 rounded-full bg-cyan-400 px-6 py-3 font-bold text-slate-950 transition hover:bg-cyan-300">Tambah Client</button>
        </form>

        <div class="overflow-hidden rounded-[1.75rem] border border-white/10 bg-slate-900/70">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Image</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Sector</th>
                        <th class="px-6 py-4">Order</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($clients as $client)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($client->image_url)
                                    <img src="{{ $client->image_url }}" class="h-16 w-24 rounded-xl object-cover" alt="{{ $client->name }}">
                                @else
                                    <div class="grid h-16 w-24 place-items-center rounded-xl bg-white/5 text-xs text-slate-500">No image</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-white">{{ $client->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $client->sector }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $client->sort_order }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('admin.clients.edit', $client) }}" class="rounded-full border border-white/10 px-4 py-2 text-xs font-semibold text-white transition hover:bg-white/5">Edit</a>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus client ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full border border-rose-400/30 bg-rose-400/10 px-4 py-2 text-xs font-semibold text-rose-100 transition hover:bg-rose-400/20">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400">Belum ada client.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
