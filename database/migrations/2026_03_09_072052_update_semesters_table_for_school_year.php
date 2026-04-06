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
        Schema::table('semesters', function (Blueprint $table) {
            if (\Illuminate\Support\Facades\DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(['academic_year_id']);
            }
            $table->dropColumn('academic_year_id');
            $table->foreignId('school_year_id')->nullable()->constrained('school_years')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('semesters', function (Blueprint $table) {
            if (\Illuminate\Support\Facades\DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(['school_year_id']);
            }
            $table->dropColumn('school_year_id');
            $table->foreignId('academic_year_id')->nullable()->constrained('academic_years')->nullOnDelete();
        });
    }
};
