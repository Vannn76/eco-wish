<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('eco_missions', function (Blueprint $table) {
            $table->integer('point_reward')->default(10); // default 10 poin
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eco_missions', function (Blueprint $table) {
            //
        });
    }
};