<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('home_seo_title')->nullable()->after('company_name');
            $table->text('home_seo_description')->nullable()->after('home_seo_title');
            $table->text('home_seo_keywords')->nullable()->after('home_seo_description');

            $table->string('about_slug')->nullable()->after('about_description');
            $table->string('about_seo_title')->nullable()->after('about_slug');
            $table->text('about_seo_description')->nullable()->after('about_seo_title');
            $table->text('about_seo_keywords')->nullable()->after('about_seo_description');

            $table->string('clients_slug')->nullable()->after('about_seo_keywords');
            $table->string('clients_seo_title')->nullable()->after('clients_slug');
            $table->text('clients_seo_description')->nullable()->after('clients_seo_title');
            $table->text('clients_seo_keywords')->nullable()->after('clients_seo_description');

            $table->string('products_slug')->nullable()->after('clients_seo_keywords');
            $table->string('products_seo_title')->nullable()->after('products_slug');
            $table->text('products_seo_description')->nullable()->after('products_seo_title');
            $table->text('products_seo_keywords')->nullable()->after('products_seo_description');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_seo_title',
                'home_seo_description',
                'home_seo_keywords',
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
            ]);
        });
    }
};
