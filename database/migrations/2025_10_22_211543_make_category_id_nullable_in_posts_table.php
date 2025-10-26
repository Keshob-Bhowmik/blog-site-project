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
        Schema::table('posts', function (Blueprint $table) {
           
            $table->dropForeign(['category_id']);


            $table->bigInteger('category_id')->unsigned()->nullable()->change();


            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);

            $table->bigInteger('category_id')->unsigned()->nullable(false)->change();


            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
