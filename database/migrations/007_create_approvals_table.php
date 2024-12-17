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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id('approval_id')->primary();
            $table->unsignedBigInteger('reservation_id');
            $table->uuid('approver_id');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
            $table->text('comments');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('approver_id')->references('user_id')->on('users');
            $table->foreign('reservation_id')->references('reservation_id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
