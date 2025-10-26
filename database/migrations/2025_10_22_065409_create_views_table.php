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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 45);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->index(['post_id', 'created_at']); //to make the query fast.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
