<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('studentinformation', function (Blueprint $table) {
            $table->id();

            // Foreign key to users.matrixnumber
            $table->string('matrix_no');
            $table->foreign('matrix_no')->references('matrix_no')->on('users');

            // Other student info (nullable)
            $table->string('profile_picture')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->text('address')->nullable();
            $table->tinyInteger('year')->nullable();
            $table->tinyInteger('semester')->nullable();

            // Default role/position
            $table->string('position')->default('Normal Member');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentinformation');
    }
};
