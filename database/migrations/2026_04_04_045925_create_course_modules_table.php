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
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("subject_id")->constrained()->cascadeOnDelete();
            $table->foreignId("semester_id")->constrained()->cascadeOnDelete();
            $table->foreignId("lecturer_id")->constrained("lecturers")->cascadeOnDelete();
            $table->integer("number_of_students")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_modules');
    }
};
