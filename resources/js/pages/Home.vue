<script setup>
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';

const { site, clients, products, stats, pageLinks } = defineProps({
    site: {
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
    stats: {
        type: Array,
        default: () => [],
    },
    pageLinks: {
        type: Object,
        default: () => ({}),
    },
});

const missions = site.mission_items ?? [];
const documentationImages = computed(() => Array.from({ length: 4 }, (_, index) => site.documentation_images?.[index] ?? null));
const buildMapSrc = (address) => (address ? `https://www.google.com/maps?q=${encodeURIComponent(address)}&output=embed` : '');
const mapLink = (address) => (address ? `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}` : '');
const clientRail = computed(() => [...(clients ?? []), ...(clients ?? [])]);
const productRail = computed(() => [...(products ?? []), ...(products ?? [])]);
const mobileMenuOpen = ref(false);
const whatsappNumbers = computed(() => {
    const raw = String(site.contact_whatsapp || '').trim();

    if (!raw) {
        return [];
    }

    const matches = raw.match(/(?:\+?\d[\d\s()-]{6,}\d)/g);

    if (matches?.length) {
        return matches.map((item) => item.replace(/\s+/g, ' ').trim());
    }

    return raw
        .split(/[\r\n,;|]+/)
        .map((item) => item.trim())
        .filter(Boolean);
});

const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};

const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
};
</script>

<template>
    <Head :title="site.home_seo_title || `${site.company_name || 'Aldera Saddatech Karya'} | Company Profile`">
        <meta
            name="description"
            :content="site.home_seo_description || site.hero_description || 'Company profile perusahaan IT yang menampilkan profil perusahaan, visi misi, client, produk, dan about us.'"
        />
        <meta name="keywords" :content="site.home_seo_keywords || 'company profile, perusahaan IT, laravel, inertia, vue, tailwind'" />
        <meta property="og:title" :content="site.home_seo_title || `${site.company_name || 'Aldera Saddatech Karya'} | Company Profile`" />
        <meta property="og:description" :content="site.home_seo_description || site.hero_description || ''" />
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
                <a href="#" class="flex min-w-0 flex-1 items-center gap-3">
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
                        <p class="truncate text-xs text-slate-400">{{ site.tagline || 'IT Company Profile' }}</p>
                    </div>
                </a>

                <nav class="ml-auto hidden md:block">
                    <div class="flex items-center gap-1 rounded-full border border-white/10 bg-white/5 p-1.5 shadow-[0_16px_32px_rgba(2,6,23,0.22)] backdrop-blur">
                        <a href="#profil" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Profil</a>
                        <a :href="pageLinks.about" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Visi Misi</a>
                        <a :href="pageLinks.clients" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Client</a>
                        <a :href="pageLinks.products" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Produk</a>
                        <a :href="pageLinks.about" class="rounded-full px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">About Us</a>
                    </div>
                </nav>

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
                            <a href="#profil" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Profil</a>
                            <a :href="pageLinks.about" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Visi Misi</a>
                            <a :href="pageLinks.clients" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Client</a>
                            <a :href="pageLinks.products" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">Produk</a>
                            <a :href="pageLinks.about" class="rounded-2xl px-4 py-3 text-sm font-medium text-slate-100 transition hover:bg-white/10" @click="closeMobileMenu">About Us</a>
                        </div>
                    </div>
                </transition>
            </div>
        </header>

        <main class="relative mx-auto max-w-7xl px-4 pb-20 pt-28 sm:px-6 lg:px-8 lg:pt-32">
            <section class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div class="space-y-8" data-aos="fade-right">
                    <div class="space-y-6">
                        <p class="font-display text-sm uppercase tracking-[0.35em] text-cyan-200/80">
                            {{ site.tagline || 'Build faster. Operate smarter.' }}
                        </p>
                        <h1 class="max-w-3xl font-display text-5xl font-bold leading-tight text-white sm:text-6xl lg:text-7xl">
                            {{ site.hero_title || 'Solusi digital yang dirancang untuk perusahaan yang ingin tumbuh lebih cepat.' }}
                        </h1>
                        <p class="max-w-2xl text-lg leading-8 text-slate-300">
                            {{ site.hero_description || 'Aldera Saddatech Karya membantu perusahaan membangun website, sistem internal, dan layanan digital yang stabil, aman, serta mudah dikembangkan.' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a
                            href="#produk"
                            class="inline-flex items-center rounded-full bg-cyan-400 px-6 py-3 text-sm font-bold text-slate-950 transition hover:bg-cyan-300"
                        >
                            Lihat Produk
                        </a>
                        <a
                            href="#profil"
                            class="inline-flex items-center rounded-full border border-white/15 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
                        >
                            Profil Perusahaan
                        </a>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <div
                            v-for="(stat, index) in stats"
                            :key="stat.label"
                            class="rounded-3xl border border-white/10 bg-white/5 p-5 shadow-2xl shadow-slate-950/30 backdrop-blur"
                            data-aos="zoom-in"
                            :data-aos-delay="index * 80"
                        >
                            <p class="font-display text-3xl font-bold text-white">{{ stat.value }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-400">{{ stat.label }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left" data-aos-delay="120">
                    <div class="absolute inset-0 -z-10 rounded-[2rem] bg-gradient-to-br from-cyan-400/20 via-white/5 to-transparent blur-2xl"></div>
                    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-slate-900/80 shadow-2xl shadow-cyan-950/20 backdrop-blur-xl">
                        <img
                            v-if="site.hero_image_url"
                            :src="site.hero_image_url"
                            :alt="site.company_name || 'Hero image'"
                            class="h-[28rem] w-full object-cover"
                        />
                        <div v-else class="grid h-[28rem] place-items-center p-6">
                            <div class="space-y-4 rounded-[1.5rem] border border-white/10 bg-slate-950/70 p-6 text-center">
                                <p class="font-display text-xl font-bold text-white">Discovery to Delivery</p>
                                <p class="text-sm text-slate-400">Tambahkan gambar hero dari panel admin untuk mengganti tampilan ini.</p>
                            </div>
                        </div>
                        <div class="grid gap-4 border-t border-white/10 p-6 sm:grid-cols-2">
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Core Stack</p>
                                <p class="mt-3 font-display text-lg font-semibold text-white">Laravel + Inertia + Vue</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Design System</p>
                                <p class="mt-3 font-display text-lg font-semibold text-white">Tailwind CSS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="profil" class="scroll-mt-28 pt-24">
                <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-start">
                    <div class="space-y-4" data-aos="fade-right">
                        <p class="font-display text-sm uppercase tracking-[0.35em] text-cyan-200/80">Profil Perusahaan</p>
                        <h2 class="font-display text-4xl font-bold text-white sm:text-5xl">
                            {{ site.profile_title || 'Partner teknologi yang memahami kebutuhan bisnis, bukan hanya kebutuhan software.' }}
                        </h2>
                        <p class="max-w-2xl text-lg leading-8 text-slate-300">
                            {{ site.profile_description || 'Kami merancang dan mengembangkan solusi digital untuk membantu perusahaan bekerja lebih efisien, mengambil keputusan lebih cepat, dan memberi pengalaman yang lebih baik bagi pelanggan maupun tim internal.' }}
                        </p>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur" data-aos="fade-left" data-aos-delay="100">
                        <div class="grid grid-cols-2 gap-4">
                            <div
                                v-for="(image, index) in documentationImages"
                                :key="index"
                                class="group relative aspect-[4/3] overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-950/70 shadow-lg shadow-slate-950/10"
                            >
                                <img
                                    v-if="image"
                                    :src="image"
                                    :alt="`Dokumentasi ${index + 1}`"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                />
                                <div v-else class="grid h-full place-items-center p-4 text-center text-slate-400">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-[0.35em] text-slate-500">Dokumentasi {{ index + 1 }}</p>
                                        <p class="mt-2 text-sm leading-6">Isi dari admin</p>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/45 via-transparent to-transparent"></div>
                                <div class="absolute left-3 bottom-3 rounded-full border border-white/10 bg-slate-950/70 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.28em] text-cyan-100 backdrop-blur">
                                    {{ String(index + 1).padStart(2, '0') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="visi-misi" class="scroll-mt-28 pt-24">
                <div class="mb-10 flex flex-col gap-4" data-aos="fade-up">
                    <h2 class="font-display text-4xl font-bold text-white sm:text-5xl">Visi & Misi Perusahaan</h2>
                </div>

                <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
                    <div class="rounded-[2rem] border border-cyan-300/20 bg-cyan-400/10 p-8 ring-1 ring-cyan-300/10" data-aos="fade-right">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-200">
                            {{ site.vision_title || 'Visi' }}
                        </p>
                        <p class="mt-5 font-display text-2xl font-bold leading-relaxed text-white">
                            {{ site.vision_description || 'Menjadi mitra teknologi terpercaya yang membantu perusahaan bertumbuh dengan sistem digital yang cepat, aman, dan berkelanjutan.' }}
                        </p>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur">
                        <div class="mb-5 inline-flex w-full items-center justify-between gap-4 rounded-full border border-cyan-300/20 bg-cyan-400/10 px-5 py-3">
                            <div class="flex items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                                <p class="font-display text-sm font-semibold uppercase tracking-[0.35em] text-cyan-100">Misi</p>
                            </div>
                            <p class="text-[10px] font-semibold uppercase tracking-[0.3em] text-cyan-100/70 sm:text-xs">
                                {{ missions.length || 0 }} poin
                            </p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div
                                v-for="(mission, index) in missions"
                                :key="mission"
                                class="rounded-[1.5rem] border border-white/10 bg-slate-950/50 p-5 shadow-lg shadow-slate-950/10 backdrop-blur"
                                data-aos="fade-up"
                                :data-aos-delay="index * 90"
                            >
                                <p class="text-sm leading-7 text-slate-300">{{ mission }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="client" class="scroll-mt-28 pt-24">
                <div class="mb-10 flex flex-col gap-4" data-aos="fade-up">
                    <p class="font-display text-sm uppercase tracking-[0.35em] text-cyan-200/80">Mitra Bisnis</p>
                    <h2 class="font-display text-4xl font-bold text-white sm:text-5xl">Mitra Bisnis</h2>
                    <p class="max-w-3xl text-lg leading-8 text-slate-300">Daftar Rekanan Perusahaan</p>
                </div>

                <div class="relative overflow-hidden">
                    <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-20 bg-gradient-to-r from-slate-950 to-transparent"></div>
                    <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-20 bg-gradient-to-l from-slate-950 to-transparent"></div>
                    <div class="client-marquee flex w-max gap-4 pr-4">
                        <article
                            v-for="(client, index) in clientRail"
                            :key="`${client.id || client.name}-${index}`"
                            class="w-[18rem] shrink-0 overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/5 shadow-xl shadow-slate-950/20 transition hover:-translate-y-1 hover:bg-white/10 sm:w-[21rem] lg:w-[24rem]"
                        >
                            <div class="aspect-[16/9] bg-slate-900">
                                <img
                                    v-if="client.image_url"
                                    :src="client.image_url"
                                    :alt="client.name"
                                    class="h-full w-full object-cover"
                                />
                                <div v-else class="grid h-full place-items-center text-slate-400">
                                    Client image
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-display text-xl font-bold text-white">{{ client.name }}</p>
                                        <p class="mt-2 text-sm text-slate-400">{{ client.sector }}</p>
                                    </div>
                                </div>
                                <p class="mt-5 text-sm leading-7 text-slate-300">
                                    {{ client.description || 'Mendukung kebutuhan digital dengan pendekatan yang stabil, terukur, dan mudah dipelihara.' }}
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section id="produk" class="scroll-mt-28 pt-24">
                <div class="mb-10 flex flex-col gap-4" data-aos="fade-up">
                    <p class="font-display text-sm uppercase tracking-[0.35em] text-cyan-200/80">Produk Perusahaan</p>
                    <h2 class="font-display text-4xl font-bold text-white sm:text-5xl">Portofolio Layanan Produk Kami</h2>
                </div>

                <div class="relative overflow-hidden">
                    <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-20 bg-gradient-to-r from-slate-950 to-transparent"></div>
                    <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-20 bg-gradient-to-l from-slate-950 to-transparent"></div>
                    <div class="product-marquee flex w-max gap-6 pr-6">
                        <article
                            v-for="(product, index) in productRail"
                            :key="`${product.id || product.name}-${index}`"
                            class="w-[20rem] shrink-0 overflow-hidden rounded-[2rem] border border-white/10 bg-slate-900/70 shadow-2xl shadow-slate-950/20 transition hover:border-cyan-300/30 hover:bg-slate-900/90 sm:w-[23rem] lg:w-[26rem]"
                        >
                            <div class="aspect-[16/9] bg-slate-950">
                                <img
                                    v-if="product.image_url"
                                    :src="product.image_url"
                                    :alt="product.name"
                                    class="h-full w-full object-cover"
                                />
                                <div v-else class="grid h-full place-items-center text-slate-500">
                                    Product image
                                </div>
                            </div>
                            <div class="p-8">
                                <p class="font-display text-2xl font-bold text-white">{{ product.name }}</p>
                                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-300">
                                    {{ product.description }}
                                </p>
                                <div class="mt-6 flex flex-wrap gap-3">
                                    <span
                                        v-for="bullet in product.features || []"
                                        :key="bullet"
                                        class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold tracking-wide text-slate-200"
                                    >
                                        {{ bullet }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section id="about-us" class="scroll-mt-28 pt-24">
                <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                    <div class="self-start overflow-hidden rounded-[2rem] border border-white/10 bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.16),transparent_36%),linear-gradient(180deg,rgba(15,23,42,0.92),rgba(15,23,42,0.82))] shadow-2xl shadow-cyan-950/20" data-aos="fade-right">
                        <div v-if="site.company_address" class="relative">
                            <div class="relative h-48 sm:h-[18rem] lg:h-[22rem]">
                                <iframe
                                    :src="buildMapSrc(site.company_address)"
                                    class="h-full w-full border-0"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Google Maps company location"
                                ></iframe>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-950/10 to-transparent"></div>
                            </div>
                        </div>
                        <div v-else class="grid min-h-[16rem] place-items-center p-8 sm:min-h-[18rem] lg:min-h-[22rem]">
                            <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/70 p-6 text-center">
                                <p class="font-display text-xl font-bold text-white">Company location</p>
                                <p class="mt-2 text-sm text-slate-400">Isi alamat perusahaan di admin untuk menampilkan peta Google Maps.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2 rounded-[2rem] border border-white/10 bg-white/5 p-8 backdrop-blur" data-aos="fade-left">
                            <p class="font-display text-sm uppercase tracking-[0.35em] text-cyan-200/80">
                                {{ site.about_title || 'About Us' }}
                            </p>
                            <h2 class="mt-4 font-display text-4xl font-bold text-white">
                                Tim yang Profesional dan Kolaboratif
                            </h2>
                            <p class="mt-5 text-lg leading-8 text-slate-300">
                                {{ site.about_description || 'Kami percaya website dan sistem perusahaan harus menjadi alat yang memudahkan kerja, bukan sekadar aset visual. Karena itu, setiap solusi dibangun dengan perhatian pada konteks bisnis, performa teknis, dan pengalaman pengguna.' }}
                            </p>
                        </div>

                        <article
                            class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 backdrop-blur"
                            data-aos="fade-up"
                        >
                            <p class="font-display text-xl font-bold text-white">Contact</p>
                            <p class="mt-4 text-sm leading-7 text-slate-300">{{ site.contact_email || 'hello@aldera-saddatech.test' }}</p>
                            <p class="text-sm leading-7 text-slate-300">{{ site.contact_phone || '+62 21 555 0123' }}</p>
                        </article>

                        <article class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 backdrop-blur" data-aos="fade-up" data-aos-delay="100">
                            <p class="font-display text-xl font-bold text-white">WhatsApp</p>
                            <div class="mt-4 space-y-2 text-sm leading-7 text-slate-300">
                                <p v-if="whatsappNumbers.length">
                                    <span v-for="(number, index) in whatsappNumbers" :key="`${number}-${index}`" class="block">
                                        {{ number }}
                                    </span>
                                </p>
                                <p v-else>6281234567890</p>
                            </div>
                        </article>
                    </div>
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

<style scoped>
@keyframes marquee-left {
    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-50%);
    }
}

@keyframes marquee-right {
    from {
        transform: translateX(-50%);
    }

    to {
        transform: translateX(0);
    }
}

.client-marquee {
    animation: marquee-left 48s linear infinite;
    will-change: transform;
}

.product-marquee {
    animation: marquee-right 48s linear infinite;
    will-change: transform;
}

.client-marquee:hover,
.product-marquee:hover {
    animation-play-state: paused;
}

@media (prefers-reduced-motion: reduce) {
    .client-marquee,
    .product-marquee {
        animation: none;
        transform: none;
    }
}
</style>
