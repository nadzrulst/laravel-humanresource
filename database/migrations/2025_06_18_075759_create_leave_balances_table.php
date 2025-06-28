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
    Schema::create('leave_balances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->foreignId('leave_type_id')->constrained('leave_types')->onDelete('cascade');
        $table->integer('year');
        $table->integer('total_days');
        $table->integer('used_days');
        $table->integer('remaining_days');
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
