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
    Schema::create('salary_components', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('code');
        $table->enum('type', ['fixed', 'variable']);
        $table->decimal('default_amount', 10, 2);
        $table->boolean('is_percentage');
        $table->boolean('is_taxable');
        $table->boolean('is_active');
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
        Schema::dropIfExists('salary_components');
    }
};
