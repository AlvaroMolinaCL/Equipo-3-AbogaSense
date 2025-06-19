<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('residence_region_id')->nullable()->after('birth_date');
            $table->unsignedBigInteger('residence_commune_id')->nullable()->after('residence_region_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['residence_region_id', 'residence_commune_id']);
        });
    }
};
