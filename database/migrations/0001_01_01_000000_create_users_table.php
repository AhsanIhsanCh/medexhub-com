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
            $table->date('u_dob')->nullable();
            $table->integer('u_gender')->nullable();
            $table->string('u_address')->nullable();
            $table->string('u_cphone')->nullable();
            $table->string('u_ophone')->nullable();
            $table->string('u_hphone')->nullable();
            $table->string('u_image')->default('noimage.png');
            $table->dateTime('u_jiontimedate')->useCurrent();
            $table->string('u_jionip', 45)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
