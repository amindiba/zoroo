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
    Schema::table('producer_profiles', function (Blueprint $table) {
        $table->string('company_name')->nullable()->change();
        $table->string('national_id')->nullable()->change();
        $table->string('phone')->nullable()->change();
        $table->text('description')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('producer_profiles', function (Blueprint $table) {
        $table->string('company_name')->nullable(false)->change();
        $table->string('national_id')->nullable(false)->change();
        $table->string('phone')->nullable(false)->change();
        $table->text('description')->nullable(false)->change();
    });
}
};
