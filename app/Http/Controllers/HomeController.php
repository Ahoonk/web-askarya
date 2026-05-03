<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\SiteSetting;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $site = SiteSetting::query()->first();

        $site ??= new SiteSetting([
            'company_name' => config('app.name'),
            'home_seo_title' => 'Aldera Saddatech Karya | Company Profile',
            'home_seo_description' => 'Company profile perusahaan IT yang menampilkan profil perusahaan, visi misi, client, produk, dan about us.',
            'home_seo_keywords' => 'company profile, perusahaan IT, laravel, inertia, vue, tailwind',
            'tagline' => 'Solusi Digital untuk Perusahaan Modern',
            'hero_title' => 'Solusi digital yang dirancang untuk perusahaan yang ingin tumbuh lebih cepat.',
            'hero_description' => 'Aldera Saddatech Karya membantu perusahaan membangun website, sistem internal, dan layanan digital yang stabil, aman, serta mudah dikembangkan.',
            'profile_title' => 'Partner teknologi yang memahami kebutuhan bisnis, bukan hanya kebutuhan software.',
            'profile_description' => 'Kami merancang dan mengembangkan solusi digital untuk membantu perusahaan bekerja lebih efisien, mengambil keputusan lebih cepat, dan memberi pengalaman yang lebih baik bagi pelanggan maupun tim internal.',
            'vision_title' => 'Visi',
            'vision_description' => 'Menjadi mitra teknologi terpercaya yang membantu perusahaan bertumbuh dengan sistem digital yang cepat, aman, dan berkelanjutan.',
            'mission_items' => [
                'Membangun solusi digital yang relevan dengan kebutuhan operasional perusahaan.',
                'Menjaga kualitas implementasi melalui standar coding, testing, dan dokumentasi yang rapi.',
                'Mempercepat transformasi bisnis dengan pendekatan yang efisien dan terukur.',
                'Memberikan dukungan jangka panjang agar sistem tetap stabil saat bisnis bertumbuh.',
            ],
            'about_title' => 'About Us',
            'about_description' => 'Kami percaya website dan sistem perusahaan harus menjadi alat yang memudahkan kerja, bukan sekadar aset visual.',
            'about_slug' => 'about-us',
            'about_seo_title' => 'About Us | Aldera Saddatech Karya',
            'about_seo_description' => 'Profil perusahaan Aldera Saddatech Karya dan cara kerja tim kami.',
            'about_seo_keywords' => 'about us, company profile, tim teknologi',
            'clients_slug' => 'clients',
            'clients_seo_title' => 'Clients | Aldera Saddatech Karya',
            'clients_seo_description' => 'Daftar client dan partner yang pernah bekerja sama dengan Aldera Saddatech Karya.',
            'clients_seo_keywords' => 'client, partner, perusahaan IT',
            'products_slug' => 'products',
            'products_seo_title' => 'Products | Aldera Saddatech Karya',
            'products_seo_description' => 'Produk dan layanan digital yang dikembangkan Aldera Saddatech Karya.',
            'products_seo_keywords' => 'produk, layanan, software development',
            'company_address' => 'Jakarta, Indonesia',
        ]);

        return Inertia::render('Home', [
            'site' => $site,
            'clients' => Client::query()->orderBy('sort_order')->get(),
            'products' => Product::query()->orderBy('sort_order')->get(),
            'pageLinks' => $this->pageLinks($site),
            'stats' => [
                ['value' => '12+', 'label' => 'tahun pengalaman tim'],
                ['value' => '80+', 'label' => 'proyek digital terselesaikan'],
                ['value' => '35+', 'label' => 'client aktif dan partner'],
                ['value' => '24/7', 'label' => 'dukungan operasional'],
            ],
        ]);
    }

    private function pageLinks(SiteSetting $site): array
    {
        return [
            'about' => route('page.show', ['slug' => $site->about_slug ?: 'about-us']),
            'clients' => route('page.show', ['slug' => $site->clients_slug ?: 'clients']),
            'products' => route('page.show', ['slug' => $site->products_slug ?: 'products']),
        ];
    }
}
