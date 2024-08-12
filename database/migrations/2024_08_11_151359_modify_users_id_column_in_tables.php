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
        Schema::table('muscles', function (Blueprint $table) {
            $table->renameColumn('users_id', 'user_id');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        Schema::table('exercises', function (Blueprint $table) {
            $table->renameColumn('users_id', 'user_id');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        Schema::table('train_exercises', function (Blueprint $table) {
            $table->renameColumn('users_id', 'user_id');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        Schema::table('train_sessions', function (Blueprint $table) {
            $table->renameColumn('users_id', 'user_id');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muscles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->renameColumn('user_id', 'users_id');
        });
    
        Schema::table('exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->renameColumn('user_id', 'users_id');
        });
    
        Schema::table('train_exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->renameColumn('user_id', 'users_id');
        });
    
        Schema::table('train_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->renameColumn('user_id', 'users_id');
        });
    }
    
};
