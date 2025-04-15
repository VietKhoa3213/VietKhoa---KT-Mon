<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email');
            $table->string('subject')->nullable(); 
            $table->text('message'); 
            $table->string('status', 50)->default('new'); 
            $table->timestamp('replied_at')->nullable(); 
            $table->foreignId('replied_by_user_id')->nullable()->constrained('users');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};