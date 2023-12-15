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
        //
            Schema::table('users', function (Blueprint $table) {
                $table->string('first_name');
                $table->string('last_name');
                $table->string('fmc_token')->unique();;
                $table->string('phone_number');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('fmc_token')->unique();;
            $table->dropColumn('phone_number');
        });
    }
};
