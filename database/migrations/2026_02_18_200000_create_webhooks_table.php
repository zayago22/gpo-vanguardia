<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('evento', 50)->unique(); // contacto, bolsa, post_creado
            $table->string('url', 500);
            $table->boolean('activo')->default(false);
            $table->string('secret', 100)->nullable(); // para firmar payloads
            $table->timestamp('ultimo_envio')->nullable();
            $table->string('ultimo_estado', 20)->nullable(); // ok, error
            $table->text('ultimo_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};
