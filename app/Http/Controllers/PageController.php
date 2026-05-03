<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\SiteSetting;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $site = SiteSetting::query()->first();

        if (! $site) {
            abort(404);
        }

        $page = $this->resolvePage($site, $slug);

        if (! $page) {
            abort(404);
        }

        return Inertia::render('SectionPage', [
            'site' => $site,
            'page' => $page,
            'clients' => Client::query()->orderBy('sort_order')->get(),
            'products' => Product::query()->orderBy('sort_order')->get(),
            'pageLinks' => $this->pageLinks($site),
        ]);
    }

    private function resolvePage(SiteSetting $site, string $slug): ?array
    {
        $slug = trim($slug, '/');
        $aboutSlug = $this->siteSlug($site->about_slug, 'about-us');
        $clientsSlug = $this->siteSlug($site->clients_slug, 'clients');
        $productsSlug = $this->siteSlug($site->products_slug, 'products');

        if ($slug === $aboutSlug) {
            return [
                'key' => 'about',
                'slug' => $slug,
                'title' => $site->about_title ?: 'About Us',
                'seo_title' => $site->about_seo_title ?: ($site->about_title ?: 'About Us') . ' | ' . $site->company_name,
                'seo_description' => $site->about_seo_description ?: $site->about_description,
                'seo_keywords' => $site->about_seo_keywords,
            ];
        }

        if ($slug === $clientsSlug) {
            return [
                'key' => 'clients',
                'slug' => $slug,
                'title' => 'Client Perusahaan',
                'seo_title' => $site->clients_seo_title ?: 'Client Perusahaan | ' . $site->company_name,
                'seo_description' => $site->clients_seo_description ?: 'Daftar client dan partner perusahaan IT.',
                'seo_keywords' => $site->clients_seo_keywords,
            ];
        }

        if ($slug === $productsSlug) {
            return [
                'key' => 'products',
                'slug' => $slug,
                'title' => 'Produk Perusahaan',
                'seo_title' => $site->products_seo_title ?: 'Produk Perusahaan | ' . $site->company_name,
                'seo_description' => $site->products_seo_description ?: 'Portofolio produk dan layanan perusahaan IT.',
                'seo_keywords' => $site->products_seo_keywords,
            ];
        }

        return null;
    }

    private function pageLinks(SiteSetting $site): array
    {
        return [
            'about' => $this->buildUrl($site->about_slug ?: 'about-us'),
            'clients' => $this->buildUrl($site->clients_slug ?: 'clients'),
            'products' => $this->buildUrl($site->products_slug ?: 'products'),
        ];
    }

    private function buildUrl(string $slug): string
    {
        return route('page.show', ['slug' => trim($slug, '/')]);
    }

    private function siteSlug(?string $value, string $fallback): string
    {
        return trim($value ?: $fallback, '/');
    }
}
