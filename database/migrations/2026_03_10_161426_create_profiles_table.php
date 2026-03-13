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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');           // e.g. "Full Stack Developer"
            $table->text('tagline')->nullable(); // Hero typing texts (comma separated)
            $table->text('bio');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('projects_count')->default(0);
            $table->integer('years_experience')->default(0);
            $table->integer('clients_count')->default(0);
            $table->integer('github_stars')->default(0);
            $table->boolean('available_for_work')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};