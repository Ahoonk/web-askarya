<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSettingsSeoSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_sync_seo_from_content(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'is_admin' => true,
        ]);

        $payload = [
            'company_name' => 'Acme Tech',
            'tagline' => 'Solusi Digital Modern',
            'hero_title' => 'Membangun produk digital yang kuat dan rapi.',
            'hero_description' => 'Acme Tech membantu perusahaan membangun sistem yang cepat dan stabil.',
            'profile_title' => 'Partner teknologi untuk bisnis yang bertumbuh.',
            'profile_description' => 'Kami merancang solusi digital yang praktis dan berkelanjutan.',
            'vision_title' => 'Visi',
            'vision_description' => 'Menjadi mitra teknologi terpercaya.',
            'mission_items' => "Membangun solusi yang relevan.\nMenjaga kualitas implementasi.",
            'about_title' => 'About Us',
            'about_description' => 'Kami percaya software harus memudahkan kerja.',
            'about_slug' => 'about-us',
            'clients_slug' => 'clients',
            'products_slug' => 'products',
            'contact_email' => 'hello@acme.test',
            'contact_phone' => '+62 21 555 0000',
            'contact_whatsapp' => '6281234567890',
        ];

        $this->actingAs($admin)
            ->put(route('admin.settings.update'), [
                ...$payload,
                'sync_seo' => 1,
            ])
            ->assertRedirect(route('admin.settings.edit'))
            ->assertSessionHas('success');

        $setting = SiteSetting::query()->firstOrFail();

        $this->assertSame('Acme Tech | Company Profile', $setting->home_seo_title);
        $this->assertSame('Acme Tech membantu perusahaan membangun sistem yang cepat dan stabil.', $setting->home_seo_description);
        $this->assertSame('Acme Tech, company profile, perusahaan IT, laravel, inertia, vue, tailwind', $setting->home_seo_keywords);
        $this->assertSame('About Us | Acme Tech', $setting->about_seo_title);
        $this->assertSame('Kami percaya software harus memudahkan kerja.', $setting->about_seo_description);
        $this->assertSame('About Us, Acme Tech, company profile, tim teknologi', $setting->about_seo_keywords);
        $this->assertSame('Clients | Acme Tech', $setting->clients_seo_title);
        $this->assertSame('Daftar client dan partner yang pernah bekerja sama dengan Acme Tech.', $setting->clients_seo_description);
        $this->assertSame('client, partner, Acme Tech, perusahaan IT', $setting->clients_seo_keywords);
        $this->assertSame('Products | Acme Tech', $setting->products_seo_title);
        $this->assertSame('Produk dan layanan digital yang dikembangkan Acme Tech.', $setting->products_seo_description);
        $this->assertSame('produk, layanan, software development, Acme Tech', $setting->products_seo_keywords);
    }
}
