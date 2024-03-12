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
        Schema::table('users', function (Blueprint $table) {
            $table->string('desc')->nullable()->default("Offering a school bag in perfect condition! Ideal for students looking for a reliable and well-maintained bag. Spacious compartments, sturdy construction, and stylish design. Ready for a new school year or anyone in need of a quality backpack. DM if interested! 🎒✨ #SchoolBagForSale #BackToSchool");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
