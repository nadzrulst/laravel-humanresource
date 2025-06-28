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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('email')->unique();
        $table->string('password');
        $table->string('role');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('remember_token')->nullable();
        $table->timestamps();
        $table->enum('login_platform', ['both', 'mobile_only'])->default('mobile_only');
    });
     DB::statement('SET FOREIGN_KEY_CHECKS=1');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
