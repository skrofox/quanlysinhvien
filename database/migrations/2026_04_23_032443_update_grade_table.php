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
        Schema::table('grades', function (Blueprint $table) {
            if (Schema::hasColumn('grades', 'midterm_score')) {
                $table->dropColumn('midterm_score');
            }
            if (Schema::hasColumn('grades', 'final_score')) {
                $table->dropColumn('final_score');
            }
            if (!Schema::hasColumn('grades', 'L1')) {
                $table->string('L1')->nullable();
                $table->string('L2')->nullable();
                $table->string('L3')->nullable();
                $table->string('L4')->nullable();
            }
            if (!Schema::hasColumn('grades', 'academic_batch_id')) {
                $table->foreignId('academic_batch_id')->nullable()->constrained('academic_batches')->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->float('midterm_score');
            $table->float('final_score');
            $table->dropColumn('L1');
            $table->dropColumn('L2');
            $table->dropColumn('L3');
            $table->dropColumn('L4');
            $table->dropForeign(['academic_batch_id']);
            $table->dropColumn('academic_batch_id');
        });
    }
};
