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
    Schema::create('employee_salary_components', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->foreignId('salary_component_id')->constrained('salary_components')->onDelete('cascade');
        $table->decimal('amount', 10, 2);
        $table->boolean('is_active');
        $table->date('effective_date');
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_components');
    }
};
