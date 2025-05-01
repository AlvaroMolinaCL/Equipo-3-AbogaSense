<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_images', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('page_key');   // Ej: 'index', 'services'
            $table->string('image_key');  // Ej: 'banner', 'box1', 'about_photo'
            $table->string('image_path'); // Ruta del archivo en storage/public

            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_images');
    }
};
