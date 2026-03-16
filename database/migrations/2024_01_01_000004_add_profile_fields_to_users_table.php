<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->text('about')->nullable()->after('avatar');
            $table->string('twitter')->nullable()->after('about');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('linkedin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'about', 'twitter', 'linkedin', 'instagram']);
        });
    }
};
