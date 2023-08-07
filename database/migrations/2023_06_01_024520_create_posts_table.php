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
        Schema::create('posts', function (Blueprint $table) {
            $table->string('ulid');
            $table->string('title')->unique()->nullable()->index();
            $table->string('slug')->unique()->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->boolean('published')->default(false)->index();
            $table->timestamp('published_at')->nullable();
            $table->string('views')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
