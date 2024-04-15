<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table): void {
            $table->id('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email');
            $table->string('username');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::statement('CREATE UNIQUE INDEX users_email_uidx ON "user" (email) WHERE deleted_at IS NULL');
        \DB::statement('CREATE UNIQUE INDEX users_username_uidx ON "user" (username) WHERE deleted_at IS NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
