<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('race_year', function (Blueprint $table) {
            $table->softDeletes(); // přidá deleted_at (nullable timestamp)
            $table->timestamps();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('race_year', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
