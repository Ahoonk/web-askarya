<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::query()->first() ?? new SiteSetting([
            'company_name' => config('app.name'),
            'tagline' => 'Solusi Digital untuk Perusahaan Modern',
        ]);

        return view('admin.settings', [
            'setting' => $setting,
        ]);
    }

    public function update(Request $request)
    {
        $setting = SiteSetting::query()->firstOrNew();
        $syncSeo = $request->boolean('sync_seo');

        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'home_seo_title' => $syncSeo ? ['nullable', 'string', 'max:255'] : ['required', 'string', 'max:255'],
            'home_seo_description' => $syncSeo ? ['nullable', 'string'] : ['required', 'string'],
            'home_seo_keywords' => ['nullable', 'string'],
            'tagline' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string'],
            'hero_description' => ['required', 'string'],
            'profile_title' => ['required', 'string'],
            'profile_description' => ['required', 'string'],
            'vision_title' => ['required', 'string', 'max:255'],
            'vision_description' => ['required', 'string'],
            'mission_items' => ['required', 'string'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_description' => ['required', 'string'],
            'about_slug' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9-]+$/'],
            'about_seo_title' => $syncSeo ? ['nullable', 'string', 'max:255'] : ['required', 'string', 'max:255'],
            'about_seo_description' => $syncSeo ? ['nullable', 'string'] : ['required', 'string'],
            'about_seo_keywords' => ['nullable', 'string'],
            'clients_slug' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9-]+$/'],
            'clients_seo_title' => $syncSeo ? ['nullable', 'string', 'max:255'] : ['required', 'string', 'max:255'],
            'clients_seo_description' => $syncSeo ? ['nullable', 'string'] : ['required', 'string'],
            'clients_seo_keywords' => ['nullable', 'string'],
            'products_slug' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9-]+$/'],
            'products_seo_title' => $syncSeo ? ['nullable', 'string', 'max:255'] : ['required', 'string', 'max:255'],
            'products_seo_description' => $syncSeo ? ['nullable', 'string'] : ['required', 'string'],
            'products_seo_keywords' => ['nullable', 'string'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_whatsapp' => ['nullable', 'string', 'max:255'],
            'company_address' => ['nullable', 'string', 'max:500'],
            'logo_image' => ['nullable', 'image', 'max:2048'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'documentation_image_1' => ['nullable', 'image', 'max:4096'],
            'documentation_image_2' => ['nullable', 'image', 'max:4096'],
            'documentation_image_3' => ['nullable', 'image', 'max:4096'],
            'documentation_image_4' => ['nullable', 'image', 'max:4096'],
        ]);

        $slugs = [
            'about_slug' => trim($data['about_slug']),
            'clients_slug' => trim($data['clients_slug']),
            'products_slug' => trim($data['products_slug']),
        ];

        if (count(array_unique($slugs)) !== count($slugs)) {
            throw ValidationException::withMessages([
                'about_slug' => 'Slug About, Clients, dan Products harus berbeda.',
            ]);
        }

        if ($syncSeo) {
            $data = array_merge($data, $this->buildSyncedSeoData($data));
        }

        $setting->fill([
            'company_name' => $data['company_name'],
            'home_seo_title' => $data['home_seo_title'],
            'home_seo_description' => $data['home_seo_description'],
            'home_seo_keywords' => $data['home_seo_keywords'] ?? null,
            'tagline' => $data['tagline'],
            'hero_title' => $data['hero_title'],
            'hero_description' => $data['hero_description'],
            'profile_title' => $data['profile_title'],
            'profile_description' => $data['profile_description'],
            'vision_title' => $data['vision_title'],
            'vision_description' => $data['vision_description'],
            'mission_items' => collect(preg_split("/\r\n|\n|\r/", $data['mission_items']))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values()
                ->all(),
            'about_title' => $data['about_title'],
            'about_description' => $data['about_description'],
            'about_slug' => $data['about_slug'],
            'about_seo_title' => $data['about_seo_title'],
            'about_seo_description' => $data['about_seo_description'],
            'about_seo_keywords' => $data['about_seo_keywords'] ?? null,
            'clients_slug' => $data['clients_slug'],
            'clients_seo_title' => $data['clients_seo_title'],
            'clients_seo_description' => $data['clients_seo_description'],
            'clients_seo_keywords' => $data['clients_seo_keywords'] ?? null,
            'products_slug' => $data['products_slug'],
            'products_seo_title' => $data['products_seo_title'],
            'products_seo_description' => $data['products_seo_description'],
            'products_seo_keywords' => $data['products_seo_keywords'] ?? null,
            'contact_email' => $data['contact_email'] ?? null,
            'contact_phone' => $data['contact_phone'] ?? null,
            'contact_whatsapp' => $data['contact_whatsapp'] ?? null,
            'company_address' => $data['company_address'] ?? null,
        ]);

        $this->storeImage($request, $setting, 'logo_image', 'logo_image_path');
        $this->storeImage($request, $setting, 'hero_image', 'hero_image_path');
        $this->storeImage($request, $setting, 'documentation_image_1', 'documentation_image_1_path');
        $this->storeImage($request, $setting, 'documentation_image_2', 'documentation_image_2_path');
        $this->storeImage($request, $setting, 'documentation_image_3', 'documentation_image_3_path');
        $this->storeImage($request, $setting, 'documentation_image_4', 'documentation_image_4_path');

        $setting->save();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Pengaturan website berhasil disimpan.');
    }

    private function buildSyncedSeoData(array $data): array
    {
        $companyName = trim((string) ($data['company_name'] ?? config('app.name')));
        $heroDescription = trim((string) ($data['hero_description'] ?? ''));
        $profileDescription = trim((string) ($data['profile_description'] ?? ''));
        $aboutTitle = trim((string) ($data['about_title'] ?? 'About Us'));
        $aboutDescription = trim((string) ($data['about_description'] ?? ''));

        return [
            'home_seo_title' => $companyName . ' | Company Profile',
            'home_seo_description' => $heroDescription ?: $profileDescription,
            'home_seo_keywords' => trim($companyName . ', company profile, perusahaan IT, laravel, inertia, vue, tailwind'),
            'about_seo_title' => $aboutTitle . ' | ' . $companyName,
            'about_seo_description' => $aboutDescription ?: $profileDescription ?: $heroDescription,
            'about_seo_keywords' => trim($aboutTitle . ', ' . $companyName . ', company profile, tim teknologi'),
            'clients_seo_title' => 'Clients | ' . $companyName,
            'clients_seo_description' => 'Daftar client dan partner yang pernah bekerja sama dengan ' . $companyName . '.',
            'clients_seo_keywords' => trim('client, partner, ' . $companyName . ', perusahaan IT'),
            'products_seo_title' => 'Products | ' . $companyName,
            'products_seo_description' => 'Produk dan layanan digital yang dikembangkan ' . $companyName . '.',
            'products_seo_keywords' => trim('produk, layanan, software development, ' . $companyName),
        ];
    }

    private function storeImage(Request $request, SiteSetting $setting, string $input, string $column): void
    {
        if (! $request->hasFile($input)) {
            return;
        }

        if ($setting->{$column}) {
            Storage::disk('public')->delete($setting->{$column});
        }

        $setting->{$column} = $request->file($input)->store('site', 'public');
    }
}
