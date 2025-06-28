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
        Schema::table('meetings', function (Blueprint $table) {
            $table->text('agenda')->nullable();
            $table->string('minutes_path')->nullable();
            $table->string('financial_path')->nullable();
            $table->string('official_letter_path')->nullable();
            $table->text('memo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn([
                'agenda',
                'minutes_path',
                'financial_path',
                'official_letter_path',
                'memo'
            ]);
        });
    }
};
