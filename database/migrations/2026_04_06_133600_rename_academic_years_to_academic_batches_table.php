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
        // 1. Đổi tên bảng academic_years thành academic_batches
        Schema::rename('academic_years', 'academic_batches');

        // 2. Đổi tên cột trong bảng school_classes
        Schema::table('school_classes', function (Blueprint $table) {
            $table->renameColumn('academic_year_id', 'academic_batch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_classes', function (Blueprint $table) {
            $table->renameColumn('academic_batch_id', 'academic_year_id');
        });

        Schema::rename('academic_batches', 'academic_years');
    }
};
