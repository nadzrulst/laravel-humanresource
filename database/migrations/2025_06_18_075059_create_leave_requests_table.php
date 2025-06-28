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
    Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->foreignId('leave_type_id')->constrained('leave_types')->onDelete('cascade');
        $table->date('start_date');
        $table->date('end_date');
        $table->integer('total_days');
        $table->text('reason');
        $table->enum('status', ['pending', 'approved', 'rejected']);
        $table->integer('approved_by')->nullable();
        $table->dateTime('approved_at')->nullable();
        $table->text('rejection_reason')->nullable();
        $table->string('attachment')->nullable();
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
