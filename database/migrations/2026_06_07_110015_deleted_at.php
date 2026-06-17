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
            $table->addColumn('description', 'text')->nullable(); // přidá sloupec description (text, nullable)
        });
    }

    public function down(): void
    {
        Schema::table('race_year', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('description');
            $table->dropTimestamps();
        });
    }
};
