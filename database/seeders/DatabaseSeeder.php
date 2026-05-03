<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->where('email', 'admin@nusantaratech.test')->delete();

        User::updateOrCreate(
            ['email' => 'admin@aldera-saddatech.test'],
            [
                'name' => 'Admin Aldera Saddatech Karya',
                'password' => 'Admin12345!',
                'is_admin' => true,
            ]
        );

        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'company_name' => 'Aldera Saddatech Karya',
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
            'contact_email' => 'hello@aldera-saddatech.test',
            'contact_phone' => '+62 21 555 0123',
            'contact_whatsapp' => '6281234567890',
            'company_address' => 'Jakarta, Indonesia',
        ]);

        Client::query()->delete();
        Product::query()->delete();

        Client::insert([
            ['name' => 'PT Sigma Integra', 'sector' => 'Manufacturing', 'description' => 'Sistem operasional dan dashboard produksi.', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PT Bumi Data Nusantara', 'sector' => 'Enterprise SaaS', 'description' => 'Portal layanan internal dan pengelolaan data.', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CV Aksara Logistik', 'sector' => 'Logistics', 'description' => 'Aplikasi tracking pengiriman dan monitoring armada.', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Product::insert([
            ['name' => 'Enterprise Web App', 'description' => 'Aplikasi web internal untuk operasional, dashboard manajemen, dan proses bisnis harian.', 'features' => json_encode(['Role-based access', 'Dashboard real-time', 'API integration']), 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Company Portal', 'description' => 'Portal informasi dan layanan yang memudahkan komunikasi dengan client, partner, dan tim internal.', 'features' => json_encode(['CMS-friendly', 'Responsive design', 'SEO-ready']), 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
