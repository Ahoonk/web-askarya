@extends('admin.layout')

@section('content')
    @php
        $missionText = old('mission_items', implode(PHP_EOL, $setting->mission_items ?? []));
        $companyAddress = old('company_address', $setting->company_address ?? '');
        $documentationImages = $setting->documentation_images ?? [];
    @endphp

    <div class="space-y-6">
        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8">
            <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/80">Settings</p>
            <h1 class="mt-3 font-display text-4xl font-bold text-white">Edit konten halaman depan</h1>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
                    <h2 class="font-display text-2xl font-bold text-white">General</h2>
                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Company name</label>
                            <input name="company_name" value="{{ old('company_name', $setting->company_name ?? 'Aldera Saddatech Karya') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Tagline</label>
                            <input name="tagline" value="{{ old('tagline', $setting->tagline ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Contact email</label>
                            <input name="contact_email" value="{{ old('contact_email', $setting->contact_email ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Contact phone</label>
                            <input name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">WhatsApp</label>
                            <input name="contact_whatsapp" value="{{ old('contact_whatsapp', $setting->contact_whatsapp ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Company address</label>
                            <textarea name="company_address" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ $companyAddress }}</textarea>
                            <p class="mt-2 text-xs text-slate-500">Alamat ini dipakai untuk peta Google Maps di halaman About.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
                    <h2 class="font-display text-2xl font-bold text-white">Images, Documentation & Location</h2>
                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Logo image</label>
                            <input type="file" name="logo_image" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:font-bold file:text-slate-950">
                            @if (!empty($setting->logo_image_url))
                                <div class="mt-3 inline-flex rounded-2xl border border-white/10 bg-white p-2 shadow-lg shadow-slate-950/20">
                                    <img src="{{ $setting->logo_image_url }}" class="h-24 w-24 rounded-xl object-contain" alt="Logo preview">
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Hero image</label>
                            <input type="file" name="hero_image" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:font-bold file:text-slate-950">
                            @if (!empty($setting->hero_image_url))
                                <img src="{{ $setting->hero_image_url }}" class="mt-3 h-40 w-full rounded-2xl object-cover" alt="Hero preview">
                            @endif
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Documentation photos</label>
                            <div class="grid gap-4 sm:grid-cols-2">
                                @foreach ([1, 2, 3, 4] as $index)
                                    @php
                                        $docInput = 'documentation_image_' . $index;
                                        $docPreview = $documentationImages[$index - 1] ?? null;
                                    @endphp
                                    <div class="rounded-2xl border border-white/10 bg-slate-950/70 p-4">
                                        <label class="mb-2 block text-xs uppercase tracking-[0.3em] text-slate-500">Photo {{ $index }}</label>
                                        <input type="file" name="{{ $docInput }}" accept="image/*" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:font-bold file:text-slate-950">
                                        @if (!empty($docPreview))
                                            <img src="{{ $docPreview }}" class="mt-3 h-28 w-full rounded-2xl object-cover" alt="Documentation preview {{ $index }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-slate-500">Foto ini akan tampil sebagai dokumentasi 2x2 di homepage.</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Location preview</label>
                            @if (!empty($companyAddress))
                                <div class="overflow-hidden rounded-2xl border border-white/10 bg-slate-950/70">
                                    <iframe
                                        title="Company location map"
                                        src="https://www.google.com/maps?q={{ urlencode($companyAddress) }}&output=embed"
                                        class="h-64 w-full border-0"
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                    ></iframe>
                                </div>
                            @else
                                <div class="grid h-64 place-items-center rounded-2xl border border-white/10 bg-slate-950/70 text-sm text-slate-400">
                                    Isi alamat perusahaan terlebih dahulu untuk menampilkan peta.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
                    <h2 class="font-display text-2xl font-bold text-white">Homepage Content</h2>
                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Homepage SEO title</label>
                            <input name="home_seo_title" value="{{ old('home_seo_title', $setting->home_seo_title ?? 'Aldera Saddatech Karya | Company Profile') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Homepage SEO description</label>
                            <textarea name="home_seo_description" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('home_seo_description', $setting->home_seo_description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Homepage SEO keywords</label>
                            <textarea name="home_seo_keywords" rows="2" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('home_seo_keywords', $setting->home_seo_keywords ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Hero title</label>
                            <textarea name="hero_title" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('hero_title', $setting->hero_title ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Hero description</label>
                            <textarea name="hero_description" rows="4" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('hero_description', $setting->hero_description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Profile title</label>
                            <textarea name="profile_title" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('profile_title', $setting->profile_title ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Profile description</label>
                            <textarea name="profile_description" rows="4" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('profile_description', $setting->profile_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
                    <h2 class="font-display text-2xl font-bold text-white">Vision & About</h2>
                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Vision title</label>
                            <input name="vision_title" value="{{ old('vision_title', $setting->vision_title ?? 'Visi') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Vision description</label>
                            <textarea name="vision_description" rows="4" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('vision_description', $setting->vision_description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">Mission items, satu baris satu poin</label>
                            <textarea name="mission_items" rows="6" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ $missionText }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">About title</label>
                            <input name="about_title" value="{{ old('about_title', $setting->about_title ?? 'About Us') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">About description</label>
                            <textarea name="about_description" rows="5" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('about_description', $setting->about_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-[1.75rem] border border-white/10 bg-slate-900/70 p-6">
                <h2 class="font-display text-2xl font-bold text-white">SEO & Slugs</h2>
                <p class="mt-2 text-sm text-slate-400">Atur slug dan meta tiap halaman agar URL dan title tiap halaman bisa berbeda.</p>
                <p class="mt-2 text-sm text-cyan-200/80">Klik tombol sinkronisasi bila ingin title dan description SEO diisi otomatis dari konten yang sudah ada.</p>

                <div class="mt-5 grid gap-6 lg:grid-cols-3">
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-5">
                        <p class="font-display text-xl font-bold text-white">About Page</p>
                        <div class="mt-4 space-y-3">
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">Slug</label>
                                <input name="about_slug" value="{{ old('about_slug', $setting->about_slug ?? 'about-us') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO title</label>
                                <input name="about_seo_title" value="{{ old('about_seo_title', $setting->about_seo_title ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO description</label>
                                <textarea name="about_seo_description" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('about_seo_description', $setting->about_seo_description ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO keywords</label>
                                <textarea name="about_seo_keywords" rows="2" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('about_seo_keywords', $setting->about_seo_keywords ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-5">
                        <p class="font-display text-xl font-bold text-white">Clients Page</p>
                        <div class="mt-4 space-y-3">
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">Slug</label>
                                <input name="clients_slug" value="{{ old('clients_slug', $setting->clients_slug ?? 'clients') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO title</label>
                                <input name="clients_seo_title" value="{{ old('clients_seo_title', $setting->clients_seo_title ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO description</label>
                                <textarea name="clients_seo_description" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('clients_seo_description', $setting->clients_seo_description ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO keywords</label>
                                <textarea name="clients_seo_keywords" rows="2" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('clients_seo_keywords', $setting->clients_seo_keywords ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-5">
                        <p class="font-display text-xl font-bold text-white">Products Page</p>
                        <div class="mt-4 space-y-3">
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">Slug</label>
                                <input name="products_slug" value="{{ old('products_slug', $setting->products_slug ?? 'products') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO title</label>
                                <input name="products_seo_title" value="{{ old('products_seo_title', $setting->products_seo_title ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO description</label>
                                <textarea name="products_seo_description" rows="3" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('products_seo_description', $setting->products_seo_description ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm text-slate-300">SEO keywords</label>
                                <textarea name="products_seo_keywords" rows="2" class="w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white">{{ old('products_seo_keywords', $setting->products_seo_keywords ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-full bg-cyan-400 px-6 py-3 font-bold text-slate-950 transition hover:bg-cyan-300">
                        Simpan Settings
                    </button>
                    <button
                        type="submit"
                        name="sync_seo"
                        value="1"
                        class="rounded-full border border-cyan-300/40 bg-cyan-400/10 px-6 py-3 font-bold text-cyan-100 transition hover:bg-cyan-400/20"
                    >
                        Sinkronkan SEO lalu Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
