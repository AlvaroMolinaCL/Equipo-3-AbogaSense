<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Agregar la columna tenant_id como string nullable después de customer_phone
            $table->string('tenant_id')
                ->nullable()
                ->after('customer_phone');

            // Crear la relación con la tabla tenants
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onDelete('set null'); // Opcional: define el comportamiento al eliminar
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Eliminar la llave foránea primero
            $table->dropForeign(['tenant_id']);

            // Luego eliminar la columna
            $table->dropColumn('tenant_id');
        });
    }
};