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
    Schema::create('payrolls', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->integer('month');
        $table->integer('year');
        $table->decimal('basic_salary', 10, 2);
        $table->decimal('allowances', 10, 2);
        $table->decimal('overtime_pay', 10, 2);
        $table->decimal('deductions', 10, 2);
        $table->decimal('tax', 10, 2);
        $table->decimal('net_salary', 10, 2);
        $table->integer('work_days');
        $table->integer('absent_days');
        $table->enum('status', ['processed', 'unprocessed']);
        $table->dateTime('processed_at')->nullable();
        $table->integer('processed_by')->nullable();
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
