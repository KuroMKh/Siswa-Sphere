<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Drop the old user_id foreign key if it exists
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Add matrix_no instead
            $table->string('matrix_no', 12);
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('matrix_no');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};
