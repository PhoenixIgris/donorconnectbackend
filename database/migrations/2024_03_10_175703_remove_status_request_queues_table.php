<?php

use App\Enums\Status;
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
        Schema::table('request_queues', function (Blueprint $table) {
          
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_queues', function (Blueprint $table) {
           $table->enum('status', [
                Status::UNVERIFIED, Status::VERIFIED, Status::REQUESTED,
                Status::PENDING_REQUEST, Status::CLOSED
            ])->nullable()->default(Status::UNVERIFIED);
        });
    }
};
