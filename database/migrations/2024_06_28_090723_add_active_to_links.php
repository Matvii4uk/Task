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
        Schema::table('links', function (Blueprint $table) {
            $table->unsignedBigInteger('gambler_id')->after('id');
            $table->foreign('gambler_id')->references('id')->on('gamblers')->onDelete('cascade');
            $table->boolean('active')->after('slug')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('gambler_id');
            $table->dropColumn('active');
        });
    }
};
