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
<<<<<<< HEAD
            $table->addColumn('description', 'text')->nullable(); // přidá sloupec description (text, nullable)
=======
            $table->text('description')->nullable();
>>>>>>> 3ad351c43d67196a35aeafe604aac9000f0b57a4
        });
    }

    public function down(): void
    {
        Schema::table('race_year', function (Blueprint $table) {
            $table->dropSoftDeletes();
<<<<<<< HEAD
            $table->dropColumn('description');
            $table->dropTimestamps();
=======
            $table->dropTimestamps();
            $table->dropColumn('descrition');
>>>>>>> 3ad351c43d67196a35aeafe604aac9000f0b57a4
        });
    }
};
