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
    Schema::create('activity_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('activity_type');
        $table->string('table_name');
        $table->integer('record_id');
        $table->json('old_values');
        $table->json('new_values');
        $table->string('ip_address');
        $table->string('user_agent');
        $table->timestamps();
    });
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
