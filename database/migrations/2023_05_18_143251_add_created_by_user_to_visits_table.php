<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // $table->integer('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id')->nullable();
                // $table->foreignId('user_created_by')
                // ->constrained(table:'users')
                // ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            //
        });
    }
};
