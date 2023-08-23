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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('slug');
            $table->string('position')->nullable();
            $table->text('detail')->nullable();
            $table->text('image')->nullable();
            $table->text('social_facebook')->nullable();
            $table->text('social_instagram')->nullable();
            $table->text('social_twitter')->nullable();
            $table->text('social_tiktok')->nullable();
            $table->text('social_youtube')->nullable();
            $table->text('social_linktree')->nullable();
            $table->text('social_others')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
