<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    Schema::create('leave_requests_approvals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('leave_request_id')->constrained('leave_requests')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('status', ['approved', 'rejected', 'pending']);
        $table->text('comments')->nullable();
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests_approvals');
    }
};
