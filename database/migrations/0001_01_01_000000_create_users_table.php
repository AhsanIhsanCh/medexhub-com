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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('email')->unique();
            $table->string('u_fname',20)->nullable();
            $table->string('u_lname',20)->nullable();
            $table->string('password')->nullable();
            $table->integer('u_ut_id')->default('4');
            $table->dateTime('u_jiontimedate')->useCurrent();
            $table->string('u_jionip', 45)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('users_profiles', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('up_u_id')->constrained('users')->onDelete('cascade');
            $table->date('up_dob')->nullable();
            $table->integer('up_gender')->nullable();
            $table->string('up_address')->nullable();
            $table->string('up_city')->nullable();
            $table->string('up_country')->nullable();
            $table->string('up_image')->default('noimage.png');
            $table->integer('up_name_safety')->default('0');
            $table->timestamps();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('users_profiles');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
