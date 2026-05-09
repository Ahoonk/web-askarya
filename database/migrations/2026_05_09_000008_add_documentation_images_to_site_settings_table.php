<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('documentation_image_1_path')->nullable()->after('about_image_path');
            $table->string('documentation_image_2_path')->nullable()->after('documentation_image_1_path');
            $table->string('documentation_image_3_path')->nullable()->after('documentation_image_2_path');
            $table->string('documentation_image_4_path')->nullable()->after('documentation_image_3_path');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'documentation_image_1_path',
                'documentation_image_2_path',
                'documentation_image_3_path',
                'documentation_image_4_path',
            ]);
        });
    }
};
