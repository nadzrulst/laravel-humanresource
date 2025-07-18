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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('employee_code');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('phone');
        $table->text('address');
        $table->date('birth_date');
        $table->enum('gender', ['male', 'female']);
        $table->date('hire_date');
        $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
        $table->foreignId('position_id')->constrained('positions')->onDelete('cascade');
        $table->decimal('basic_salary', 10, 2);
        $table->enum('status', ['active', 'inactive']);
        $table->string('photo')->nullable();
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
