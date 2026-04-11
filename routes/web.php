<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('sinh-vien', [HomeController::class, 'index'])->name('sinh_vien');
Route::get('giang-vien', [HomeController::class, 'giang_vien'])->name('giang_vien');

// Tin tức
Route::get('tin-tuc', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('tin-tuc/{slug}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.show');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/sinh-vien/api/courses', [\App\Http\Controllers\StudentActionController::class, 'getAvailableCourses']);
    Route::post('/sinh-vien/api/register', [\App\Http\Controllers\StudentActionController::class, 'register']);
    Route::post('/sinh-vien/api/cancel', [\App\Http\Controllers\StudentActionController::class, 'cancelRegistration']);
    Route::get('/sinh-vien/api/course-students/{courseId}', [\App\Http\Controllers\StudentActionController::class, 'getCourseStudents']);

    // API Giảng viên
    Route::get('/giang-vien/api/classes', [\App\Http\Controllers\LecturerActionController::class, 'getAssignedClasses']);
    Route::get('/giang-vien/api/class-students/{courseId}', [\App\Http\Controllers\LecturerActionController::class, 'getClassStudents']);
    Route::post('/giang-vien/api/save-grades', [\App\Http\Controllers\LecturerActionController::class, 'saveGrades']);
    Route::post('/giang-vien/api/add-student', [\App\Http\Controllers\LecturerActionController::class, 'addStudentToClass']);
    Route::post('/giang-vien/api/remove-student', [\App\Http\Controllers\LecturerActionController::class, 'removeStudentFromClass']);

    // API Đổi mật khẩu chung
    Route::post('/api/change-password', [\App\Http\Controllers\HomeController::class, 'changePassword']);


});

require __DIR__ . '/auth.php';

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Trang Thông điệp Hiệu trưởng
Route::get('/gioi-thieu/thong-diep-hieu-truong', [App\Http\Controllers\GioiThieuController::class, 'thongDiepHieuTruong'])
     ->name('thong-diep-hieu-truong');

// CAU HINH ROUTE MENU
Route::view('/gioi-thieu/lich-su-phat-trien', 'gioi-thieu.lich-su-phat-trien')->name('gioi-thieu.lich-su-phat-trien');
Route::view('/gioi-thieu/su-mang-tam-nhin', 'gioi-thieu.su-mang-tam-nhin')->name('gioi-thieu.su-mang-tam-nhin');
Route::view('/gioi-thieu/triet-ly-giao-duc', 'gioi-thieu.triet-ly-giao-duc')->name('gioi-thieu.triet-ly-giao-duc');
Route::view('/gioi-thieu/dinh-huong-chien-luoc', 'gioi-thieu.dinh-huong-chien-luoc')->name('gioi-thieu.dinh-huong-chien-luoc');
Route::view('/gioi-thieu/co-cau-to-chuc', 'gioi-thieu.co-cau-to-chuc')->name('gioi-thieu.co-cau-to-chuc');
Route::view('/tuyen-sinh/thong-tin', 'tuyen-sinh.thong-tin')->name('tuyen-sinh.thong-tin');
Route::view('/tuyen-sinh/thong-bao', 'tuyen-sinh.thong-bao')->name('tuyen-sinh.thong-bao');
Route::view('/tuyen-sinh/phieu-dang-ky', 'tuyen-sinh.phieu-dang-ky')->name('tuyen-sinh.phieu-dang-ky');
Route::view('/dao-tao/tra-cuu', 'dao-tao.tra-cuu')->name('dao-tao.tra-cuu');
Route::view('/dao-tao/lo-trinh-hoc', 'dao-tao.lo-trinh-hoc')->name('dao-tao.lo-trinh-hoc');
Route::view('/phong-ban/ban-giam-hieu', 'phong-ban.ban-giam-hieu')->name('phong-ban.ban-giam-hieu');
Route::view('/phong-ban/quan-ly-dao-tao', 'phong-ban.quan-ly-dao-tao')->name('phong-ban.quan-ly-dao-tao');
Route::view('/phong-ban/tong-hop', 'phong-ban.tong-hop')->name('phong-ban.tong-hop');
Route::view('/phong-ban/ke-hoach-tai-chinh', 'phong-ban.ke-hoach-tai-chinh')->name('phong-ban.ke-hoach-tai-chinh');
Route::view('/phong-ban/cong-tac-sinh-vien', 'phong-ban.cong-tac-sinh-vien')->name('phong-ban.cong-tac-sinh-vien');
Route::view('/phong-ban/doan-thanh-nien', 'phong-ban.doan-thanh-nien')->name('phong-ban.doan-thanh-nien');
Route::view('/phong-ban/trung-tam-tuyen-sinh', 'phong-ban.trung-tam-tuyen-sinh')->name('phong-ban.trung-tam-tuyen-sinh');
Route::view('/trung-tam/tin-hoc-ngoai-ngu', 'trung-tam.tin-hoc-ngoai-ngu')->name('trung-tam.tin-hoc-ngoai-ngu');

