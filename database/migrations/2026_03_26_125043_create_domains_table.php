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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('registrar_account_id')->constrained()->cascadeOnDelete();

            $table->string('host')->nullable();
            $table->string('host_user')->nullable();
            $table->date('expires_at');
            $table->string('status')->default('ativo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
