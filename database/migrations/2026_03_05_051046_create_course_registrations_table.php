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
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained("users")->cascadeOnDelete();
            $table->foreignId("course_module_id")->constrained("course_modules")->cascadeOnDelete();
            $table->dateTime("registration_date")->useCurrent();
            $table->timestamps();


            $table->unique(['student_id', 'course_module_id']);
        });
    }

    // Một sinh viên có thể đăng ký nhiều khóa học khác nhau ✅

    // Một khóa học có thể có nhiều sinh viên ✅

    // Nhưng một sinh viên không thể đăng ký cùng một khóa 2 lần ❌

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};
