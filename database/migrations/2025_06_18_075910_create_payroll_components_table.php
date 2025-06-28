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
    Schema::create('payroll_components', function (Blueprint $table) {
        $table->id();
        $table->foreignId('payroll_id')->constrained('payrolls')->onDelete('cascade');
        $table->string('component_type');
        $table->string('component_name');
        $table->decimal('amount', 10, 2);
        $table->boolean('is_taxable');
        $table->text('description');
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_component');
    }
};
