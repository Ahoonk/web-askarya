<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

const { site, page, clients, products, pageLinks } = defineProps({
    site: {
        type: Object,
        default: () => ({}),
    },
    page: {
        type: Object,
        default: () => ({}),
    },
    clients: {
        type: Array,
        default: () => [],
    },
    products: {
        type: Array,
        default: () => [],
    },
    pageLinks: {
        type: Object,
        default: () => ({}),
    },
});

const title = page.seo_title || `${page.title || 'Page'} | ${site.company_name || 'Aldera Saddatech Karya'}`;
const description = page.seo_description || site.hero_description || '';
const buildMapSrc = (address) => (address ? `https://www.google.com/maps?q=${encodeURIComponent(address)}&output=embed` : '');
const mapLink = (address) => (address ? `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}` : '');
const mobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};

const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
};
</script>

<template>
    <Head :title="title">
        <meta name="description" :content="description" />
        <meta name="keywords" :content="page.seo_keywords || ''" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
    </Head>

    <div class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-[-8rem] top-[-6rem] h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
            <div class="absolute right-[-8rem] top-40 h-80 w-80 rounded-full bg-teal-400/10 blur-3xl"></div>
            <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
        </div>

        <header class="fixed inset-x-0 top-4 z-50 px-4">
            <div class="relative mx-auto max-w-7xl">
            <div class="flex items-center gap-4 rounded-[1.5rem] border border-white/10 bg-slate-950/75 px-4 py-3 shadow-[0_18px_40px_rgba(2,6,23,0.35)] backdrop-blur-xl sm:px-6 lg:px-8">
                <a href="/" class="flex min-w-0 flex-1 items-center gap-3">
                    <div class="relative isolate shrink-0">
                        <div class="absolute inset-[-0.2rem] rounded-[1rem] bg-[radial-gradient(circle_at_30%_30%,rgba(148,163,184,0.18),transparent_58%),radial-gradient(circle_at_70%_70%,rgba(100,116,139,0.12),transparent_54%)] blur-md"></div>
                        <div class="absolute inset-0 rounded-[1rem] bg-gradient-to-br from-slate-500/14 via-slate-600/8 to-slate-800/16"></div>
                        <div
                            v-if="site.logo_image_url"
                            class="relative grid h-10 w-10 place-items-center overflow-hidden rounded-[1rem] border border-slate-200/80 bg-white p-1 shadow-[0_14px_26px_rgba(2,6,23,0.18)] ring-1 ring-slate-200/70 sm:h-11 sm:w-11"
                        >
                            <img :src="site.logo_image_url" :alt="site.company_name || 'Logo'" class="-translate-y-[5px] h-full w-full object-contain object-center drop-shadow-[0_6px_12px_rgba(15,23,42,0.16)]" />
                        </div>
                        <div v-else class="relative grid h-10 w-10 place-items-center overflow-hidden rounded-[1rem] border border-slate-200/80 bg-white p-1 shadow-[0_14px_26px_rgba(2,6,23,0.18)] ring-1 ring-slate-200/70 sm:h-11 sm:w-11">
                            <span class="font-display text-lg font-bold tracking-tight text-cyan-200">NT</span>
                        </div>
                    </div>
                    <div class="min-w-0">
                        <p class="font-display text-base font-bold tracking-tight text-white">
                            {{ site.company_name || 'Aldera Saddatech Karya' }}
                        </p>
                        <p class="truncate text-xs text-slate-400">{{ page.title }}</p>
                    </div>
                </a>

                <nav class="ml-auto hidden md:block">
                    <div class="flex items-center gap-1 rounded-full border border-white/10 bg-white/5 p-1.5 shadow-[0_16px_32px_rgba(2,6,23,0.22)] backdrop-blur">
                        <a href="/" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Home</a>
                        <a :href="pageLinks.about" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">About</a>
                        <a :href="pageLinks.clients" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Clients</a>
                        <a :href="pageLinks.products" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Products</a>
                    </div>
                </nav>

                <a
                    href="/"
                    class="hidden items-center rounded-full border border-cyan-300/30 bg-cyan-400/10 px-4 py-2 text-sm font-semibold text-cyan-100 transition hover:bg-cyan-400/20 md:inline-flex"
                >
                    Back Home
                </a>

                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/5 p-3 text-slate-100 transition hover:bg-white/10 md:hidden"
                    :aria-expanded="mobileMenuOpen"
                    aria-label="Toggle mobile navigation"
                    @click="toggleMobileMenu"
                >
                    <svg v-if="!mobileMenuOpen" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M4 6h16" />
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />
                    </svg>
                    <svg v-else viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M6 6l12 12" />
                        <path d="M18 6l-12 12" />
                    </svg>
                </button>
            </div>

            <transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-3 scale-95"
                enter-to-class="opacity-100 translate-y-0 scale-100"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0 scale-100"
                leave-to-class="opacity-0 -translate-y-3 scale-95"
            >
                <div
                    v-show="mobileMenuOpen"
                    class="absolute left-0 right-0 top-[calc(100%+0.75rem)] rounded-[1.5rem] border border-white/10 bg-slate-950/95 p-3 shadow-[0_18px_40px_rgba(2,6,23,0.35)] backdrop-blur-xl md:hidden"
                >
                    <div class="grid gap-2">
                        <a href="/" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Home</a>
                        <a :href="pageLinks.about" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">About</a>
                        <a :href="pageLinks.clients" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Clients</a>
                        <a :href="pageLinks.products" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Products</a>
                    </div>
                </div>
            </transition>
            </div>
        </header>

        <main class="relative mx-auto max-w-7xl px-4 pb-20 pt-28 sm:px-6 lg:px-8 lg:pt-32">
            <section class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                <div class="space-y-6" data-aos="fade-right">
                    <p class="font-display text-sm uppercase tracking-[0.35em] text-cyan-200/80">SEO Friendly Page</p>
                    <h1 class="font-display text-5xl font-bold leading-tight text-white sm:text-6xl">
                        {{ page.title }}
                    </h1>
                    <p class="max-w-2xl text-lg leading-8 text-slate-300">
                        {{ description }}
                    </p>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur" data-aos="fade-left">
                    <div v-if="page.key === 'about'" class="space-y-4">
                        <div v-if="site.company_address" class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.16),transparent_36%),linear-gradient(180deg,rgba(15,23,42,0.92),rgba(15,23,42,0.82))]">
                            <div class="relative h-48 sm:h-72">
                                <iframe
                                    :src="buildMapSrc(site.company_address)"
                                    class="h-full w-full border-0"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Google Maps company location"
                                ></iframe>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-950/10 to-transparent"></div>
                            </div>
                            <div class="border-t border-white/10 bg-slate-950/80 p-4 sm:p-5">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <p class="min-w-0 text-sm leading-6 text-slate-200 sm:text-base sm:leading-7">
                                        {{ site.company_address }}
                                    </p>
                                    <a
                                        :href="mapLink(site.company_address)"
                                        target="_blank"
                                        rel="noreferrer"
                                        class="inline-flex w-full shrink-0 items-center justify-center rounded-full border border-cyan-300/25 bg-cyan-400/10 px-4 py-2.5 text-sm font-semibold text-cyan-100 transition hover:bg-cyan-400/20 hover:text-white sm:w-auto"
                                    >
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div v-else class="grid h-64 place-items-center rounded-[1.5rem] border border-white/10 bg-slate-950/70 p-5 text-center">
                            <div>
                                <p class="font-display text-2xl font-bold text-white">Company location</p>
                                <p class="mt-3 text-sm leading-7 text-slate-300">Isi alamat perusahaan di admin untuk menampilkan peta Google Maps.</p>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="page.key === 'clients'" class="grid gap-4">
                        <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/70 p-5">
                            <p class="font-display text-2xl font-bold text-white">Client Highlights</p>
                            <p class="mt-3 text-sm leading-7 text-slate-300">Beberapa partner bisnis yang bisa Anda tampilkan sebagai bukti pengalaman.</p>
                        </div>
                        <div class="grid gap-3">
                            <div v-for="client in clients.slice(0, 3)" :key="client.id" class="rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">
                                {{ client.name }} - {{ client.sector }}
                            </div>
                        </div>
                    </div>

                    <div v-else class="grid gap-4">
                        <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/70 p-5">
                            <p class="font-display text-2xl font-bold text-white">Product Showcase</p>
                            <p class="mt-3 text-sm leading-7 text-slate-300">Layanan dan produk yang bisa dihubungkan langsung ke kebutuhan operasional perusahaan.</p>
                        </div>
                        <div class="grid gap-3">
                            <div v-for="product in products.slice(0, 3)" :key="product.id" class="rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">
                                {{ product.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section v-if="page.key === 'about'" class="pt-24">
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="rounded-[2rem] border border-cyan-300/20 bg-cyan-400/10 p-8 ring-1 ring-cyan-300/10" data-aos="fade-right">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-200">{{ site.vision_title || 'Visi' }}</p>
                        <p class="mt-5 font-display text-2xl font-bold leading-relaxed text-white">{{ site.vision_description }}</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div
                            v-for="(mission, index) in site.mission_items || []"
                            :key="mission"
                            class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 shadow-xl shadow-slate-950/20 backdrop-blur"
                            data-aos="fade-up"
                            :data-aos-delay="index * 90"
                        >
                            <div class="flex items-center gap-3">
                                <span class="grid h-9 w-9 place-items-center rounded-full bg-white/10 font-display text-sm font-bold text-cyan-200">
                                    0{{ index + 1 }}
                                </span>
                                <p class="font-semibold text-white">Misi {{ index + 1 }}</p>
                            </div>
                            <p class="mt-4 text-sm leading-7 text-slate-300">{{ mission }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section v-else-if="page.key === 'clients'" class="pt-24">
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    <article
                        v-for="(client, index) in clients"
                        :key="client.id"
                        class="overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/5 shadow-xl shadow-slate-950/20 transition hover:-translate-y-1 hover:bg-white/10"
                        data-aos="zoom-in"
                        :data-aos-delay="index * 80"
                    >
                        <div class="aspect-[16/9] bg-slate-900">
                            <img v-if="client.image_url" :src="client.image_url" :alt="client.name" class="h-full w-full object-cover" />
                            <div v-else class="grid h-full place-items-center text-slate-400">Client image</div>
                        </div>
                        <div class="p-6">
                            <p class="font-display text-xl font-bold text-white">{{ client.name }}</p>
                            <p class="mt-2 text-sm text-slate-400">{{ client.sector }}</p>
                            <p class="mt-4 text-sm leading-7 text-slate-300">{{ client.description }}</p>
                        </div>
                    </article>
                </div>
            </section>

            <section v-else class="pt-24">
                <div class="grid gap-6 lg:grid-cols-2">
                    <article
                        v-for="(product, index) in products"
                        :key="product.id"
                        class="overflow-hidden rounded-[2rem] border border-white/10 bg-slate-900/70 shadow-2xl shadow-slate-950/20 transition hover:border-cyan-300/30 hover:bg-slate-900/90"
                        data-aos="zoom-in"
                        :data-aos-delay="index * 90"
                    >
                        <div class="aspect-[16/9] bg-slate-950">
                            <img v-if="product.image_url" :src="product.image_url" :alt="product.name" class="h-full w-full object-cover" />
                            <div v-else class="grid h-full place-items-center text-slate-500">Product image</div>
                        </div>
                        <div class="p-8">
                            <p class="font-display text-2xl font-bold text-white">{{ product.name }}</p>
                            <p class="mt-4 text-sm leading-7 text-slate-300">{{ product.description }}</p>
                            <div class="mt-6 flex flex-wrap gap-3">
                                <span
                                    v-for="feature in product.features || []"
                                    :key="feature"
                                    class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold tracking-wide text-slate-200"
                                >
                                    {{ feature }}
                                </span>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </main>

        <footer class="border-t border-white/10 bg-slate-950/80">
            <div class="mx-auto max-w-7xl px-4 py-6 text-xs text-slate-400 sm:px-6 sm:py-8 sm:text-sm lg:px-8">
                <div class="flex flex-col items-center gap-2 text-center sm:flex-row sm:items-center sm:justify-between sm:text-left">
                    <p class="font-semibold text-slate-200">{{ site.company_name || 'Aldera Saddatech Karya' }}</p>
                    <p class="leading-6">&copy; Copyright Aldera Saddatech Karya. All Rights Reserved</p>
                </div>
            </div>
        </footer>
    </div>
</template>
