<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();

            // Profile Picture
            $table->string('profile_picture')->nullable();

            // Biography/Description
            $table->text('bio')->nullable();

            // Social Media Integration
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();

            // Notification Preferences
            $table->string('notification_preference')->default('email');
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
