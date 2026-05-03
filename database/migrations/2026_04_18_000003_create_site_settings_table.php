<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Aldera Saddatech Karya');
            $table->string('tagline')->default('Solusi Digital untuk Perusahaan Modern');
            $table->text('hero_title');
            $table->text('hero_description');
            $table->text('profile_title');
            $table->text('profile_description');
            $table->string('vision_title')->default('Visi');
            $table->text('vision_description');
            $table->json('mission_items')->nullable();
            $table->string('about_title')->default('About Us');
            $table->text('about_description');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('logo_image_path')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->string('about_image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
