<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'home_seo_title',
        'home_seo_description',
        'home_seo_keywords',
        'tagline',
        'hero_title',
        'hero_description',
        'profile_title',
        'profile_description',
        'vision_title',
        'vision_description',
        'mission_items',
        'about_title',
        'about_description',
        'about_slug',
        'about_seo_title',
        'about_seo_description',
        'about_seo_keywords',
        'clients_slug',
        'clients_seo_title',
        'clients_seo_description',
        'clients_seo_keywords',
        'products_slug',
        'products_seo_title',
        'products_seo_description',
        'products_seo_keywords',
        'contact_email',
        'contact_phone',
        'contact_whatsapp',
        'company_address',
        'logo_image_path',
        'hero_image_path',
        'about_image_path',
    ];

    protected function casts(): array
    {
        return [
            'mission_items' => 'array',
        ];
    }

    protected $appends = [
        'logo_image_url',
        'hero_image_url',
        'about_image_url',
    ];

    protected function logoImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->logo_image_path ? '/storage/' . ltrim($this->logo_image_path, '/') : null);
    }

    protected function heroImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->hero_image_path ? '/storage/' . ltrim($this->hero_image_path, '/') : null);
    }

    protected function aboutImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->about_image_path ? '/storage/' . ltrim($this->about_image_path, '/') : null);
    }
}
