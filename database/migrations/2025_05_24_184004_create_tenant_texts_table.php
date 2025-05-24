<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_texts', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('key');      // Por ejemplo: "banner_text", "about_title"
            $table->text('value');      // El contenido que se mostrará
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_texts');
    }
};
