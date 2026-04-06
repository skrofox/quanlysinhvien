@extends('app')

@section('content')
    <main class="bg-gray-100 min-h-screen py-8" x-data="{ activeTab: 'overview' }">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Dashboard Header -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-bold border-4 border-white shadow-md">
                        {{ substr($user->student->full_name ?? 'S', 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->student->full_name ?? 'Sinh Viên' }}</h2>
                        <p class="text-sm text-gray-500 font-medium tracking-wide">MSSV:
                            {{ $user->student->student_code ?? '01' }} |
                            Khoa:
                            {{ $user->student->schoolClass->department->department_name ?? 'Công nghệ Thông tin' }}</p>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <button
                        class="bg-white border hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium shadow-sm transition-colors text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        Thông báo
                    </button>
                    <form method="POST" action="{{ route('logout') ?? '#' }}" x-data>
                        @csrf
                        <button type="submit"
                            class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg font-medium transition-colors text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Navigation -->
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-24">
                        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menu Chức Năng</h3>
                        </div>
                        <nav class="p-2 space-y-1">
                            <a href="#" @click.prevent="activeTab = 'overview'"
                                :class="{ 'bg-blue-50 text-blue-700': activeTab === 'overview', 'text-gray-600 hover:bg-gray-50': activeTab !== 'overview' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0"
                                    :class="{ 'text-blue-600': activeTab === 'overview', 'text-gray-400': activeTab !== 'overview' }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Tổng quan
                            </a>
                            <a href="#" @click.prevent="activeTab = 'profile'"
                                :class="{ 'bg-blue-50 text-blue-700': activeTab === 'profile', 'text-gray-600 hover:bg-gray-50': activeTab !== 'profile' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0"
                                    :class="{ 'text-blue-600': activeTab === 'profile', 'text-gray-400': activeTab !== 'profile' }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Thông tin cá nhân
                            </a>
                            <a href="#" @click.prevent="activeTab = 'grades'"
                                :class="{ 'bg-blue-50 text-blue-700': activeTab === 'grades', 'text-gray-600 hover:bg-gray-50': activeTab !== 'grades' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0"
                                    :class="{ 'text-blue-600': activeTab === 'grades', 'text-gray-400': activeTab !== 'grades' }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Kết quả học tập
                            </a>
                            <a href="#" @click.prevent="activeTab = 'registration'"
                                :class="{ 'bg-blue-50 text-blue-700': activeTab === 'registration', 'text-gray-600 hover:bg-gray-50': activeTab !== 'registration' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0"
                                    :class="{ 'text-blue-600': activeTab === 'registration', 'text-gray-400': activeTab !== 'registration' }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                Đăng ký học phần
                            </a>
                            <a href="#" @click.prevent="activeTab = 'schedule'"
                                :class="{ 'bg-blue-50 text-blue-700': activeTab === 'schedule', 'text-gray-600 hover:bg-gray-50': activeTab !== 'schedule' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0"
                                    :class="{ 'text-blue-600': activeTab === 'schedule', 'text-gray-400': activeTab !== 'schedule' }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Lịch học - Lịch thi
                            </a>
                            <a href="#" @click.prevent="activeTab = 'tuition'"
                                :class="{ 'bg-blue-50 text-blue-700': activeTab === 'tuition', 'text-gray-600 hover:bg-gray-50': activeTab !== 'tuition' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0"
                                    :class="{ 'text-blue-600': activeTab === 'tuition', 'text-gray-400': activeTab !== 'tuition' }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Tra cứu học phí
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content Area -->
                <div class="w-full lg:w-3/4">

                    <!-- Tab: Tổng quan -->
                    <div x-show="activeTab === 'overview'" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Tổng quan học tập</h3>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-sm font-bold text-gray-500 uppercase">Tín chỉ tích lũy</h4>
                                    <span class="bg-blue-100 text-blue-600 p-2 rounded-lg"><svg class="w-5 h-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg></span>
                                </div>
                                <div class="text-3xl font-extrabold text-gray-800">{{ $totalCredits }} <span
                                        class="text-sm font-medium text-gray-500">tín chỉ</span></div>
                                {{-- class="text-sm font-medium text-gray-500">/ 145 tc tích lũy</span></div> --}}
                            </div>
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-sm font-bold text-gray-500 uppercase">Điểm trung bình (CPA)</h4>
                                    <span class="bg-green-100 text-green-600 p-2 rounded-lg"><svg class="w-5 h-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg></span>
                                </div>
                                <div class="text-3xl font-extrabold text-gray-800">{{ $gpa10 }} <span
                                        class="text-sm font-medium text-gray-500">Hệ 10 (CPA Hệ 4:
                                        {{ $gpa4 }})</span></div>
                            </div>
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-sm font-bold text-gray-500 uppercase">Trạng thái học tập</h4>
                                    <span class="bg-purple-100 text-purple-600 p-2 rounded-lg"><svg class="w-5 h-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg></span>
                                </div>
                                <div class="text-xl font-bold text-green-600 mt-2">Đang học</div>
                            </div>
                        </div>

                        <!-- Lịch học hôm nay -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-5 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
                                <h4 class="font-bold text-gray-800">Lịch học & thi hôm nay</h4>
                                <button @click="activeTab = 'schedule'"
                                    class="text-sm text-blue-600 font-semibold hover:underline">Xem tất cả</button>
                            </div>
                            <div class="p-0">
                                <div class="divide-y divide-gray-100">
                                    <div class="p-5 flex items-start gap-4 hover:bg-blue-50/30 transition-colors">
                                        <div
                                            class="w-16 h-16 bg-blue-100 rounded-xl flex flex-col items-center justify-center flex-shrink-0 text-blue-700">
                                            <span class="text-xs font-bold uppercase">Ca 1</span>
                                            <span class="font-bold">07:00</span>
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-800 text-lg">Cấu trúc dữ liệu và Giải thuật</h5>
                                            <p class="text-gray-500 text-sm mt-1">Phòng: <strong>A3-102</strong> | GV:
                                                Nguyễn Văn A</p>
                                        </div>
                                    </div>
                                    <div class="p-5 flex items-start gap-4 hover:bg-blue-50/30 transition-colors">
                                        <div
                                            class="w-16 h-16 bg-purple-100 rounded-xl flex flex-col items-center justify-center flex-shrink-0 text-purple-700">
                                            <span class="text-xs font-bold uppercase">Ca 3</span>
                                            <span class="font-bold">13:00</span>
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-800 text-lg">Mạng máy tính (Thực hành)</h5>
                                            <p class="text-gray-500 text-sm mt-1">Phòng: <strong>Lab 4</strong> | GV: Trần
                                                Thị B</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Thông tin cá nhân -->
                    <div x-show="activeTab === 'profile'" style="display: none;" class="space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6 border-b border-gray-200 bg-gray-50/50">
                                <h3 class="text-xl font-bold text-gray-800">Thông tin cá nhân & Đổi mật khẩu</h3>
                            </div>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin Sinh viên</h4>
                                    <div class="space-y-3">
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Họ và tên:</span> <span class="font-bold">{{ $user->student->full_name ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Mã SV:</span> <span class="font-bold">{{ $user->student->student_code ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Email:</span> <span>{{ $user->email ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Khoa:</span> <span>{{ $user->student->schoolClass->department->department_name ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Lớp:</span> <span>{{ $user->student->schoolClass->class_name ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                                <div x-data="{ 
                                    currentPassword: '', 
                                    newPassword: '', 
                                    confirmPassword: '', 
                                    message: '',
                                    success: false,
                                    async submitPassword() {
                                        this.message = 'Đang xử lý...';
                                        this.success = false;
                                        try {
                                            const res = await fetch('/api/change-password', {
                                                method: 'POST',
                                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                body: JSON.stringify({
                                                    current_password: this.currentPassword,
                                                    new_password: this.newPassword,
                                                    confirm_password: this.confirmPassword
                                                })
                                            });
                                            const data = await res.json();
                                            if (res.ok && data.success) {
                                                this.success = true;
                                                this.message = 'Đổi mật khẩu thành công!';
                                                this.currentPassword = '';
                                                this.newPassword = '';
                                                this.confirmPassword = '';
                                            } else {
                                                this.success = false;
                                                this.message = data.message || 'Lỗi khi đổi mật khẩu!';
                                            }
                                        } catch (e) {
                                            this.message = 'Có lỗi xảy ra kết nối mạng!';
                                            this.success = false;
                                        }
                                    }
                                }">
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Đổi mật khẩu</h4>
                                    <form @submit.prevent="submitPassword()" class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu hiện tại</label>
                                            <input type="password" x-model="currentPassword" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu mới</label>
                                            <input type="password" x-model="newPassword" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu mới</label>
                                            <input type="password" x-model="confirmPassword" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        </div>
                                        <div x-show="message" class="text-sm font-bold" :class="success ? 'text-green-600' : 'text-red-600'" x-text="message" x-transition></div>
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition-colors shadow-sm w-full md:w-auto">Cập nhật mật khẩu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Xem điểm -->
                    <div x-data="{ selectedSemester: 'all' }" x-show="activeTab === 'grades'" style="display: none;"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Kết quả học tập</h3>
                            <select x-model="selectedSemester"
                                class="border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 max-w-xs shadow-sm">
                                <option value="all">Tất cả các kỳ</option>
                                @foreach ($semesters as $sem)
                                    <option value="{{ $sem->id }}">{{ $sem->semester_name }} -
                                        {{ $sem->schoolYear->start_year ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-500 text-sm uppercase tracking-wider">
                                        <th class="p-4 font-bold">Mã Học Phần</th>
                                        <th class="p-4 font-bold">Tên Môn Học</th>
                                        <th class="p-4 font-bold text-center">STC</th>
                                        <th class="p-4 font-bold text-center">Điểm Quá Trình</th>
                                        <th class="p-4 font-bold text-center">Điểm Thi</th>
                                        <th class="p-4 font-bold text-center">Điểm Hệ 10</th>
                                        <th class="p-4 font-bold text-center">Điểm Hệ 4</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-gray-700">
                                    @forelse($groupedGrades as $semesterId => $gradesList)
                                        @foreach ($gradesList as $grade)
                                            <tr x-show="selectedSemester === 'all' || selectedSemester == '{{ $semesterId }}'"
                                                class="hover:bg-gray-50">
                                                <td class="p-4 font-medium text-blue-700">
                                                    {{ $grade->courseModule->subject->subject_code ?? 'N/A' }}</td>
                                                <td class="p-4 font-bold">
                                                    {{ $grade->courseModule->subject->subject_name ?? 'N/A' }}</td>
                                                <td class="p-4 text-center">
                                                    {{ $grade->courseModule->subject->number_of_credits ?? 0 }}</td>
                                                <td class="p-4 text-center text-sm"><span class="text-gray-400">CC:</span>
                                                    {{ $grade->attendance_score }} <br> <span
                                                        class="text-gray-400">GK:</span> {{ $grade->midterm_score }}</td>
                                                <td class="p-4 text-center">{{ $grade->final_score }}</td>
                                                <td class="p-4 text-center font-extrabold text-gray-800">
                                                    {{ $grade->average_score }}</td>
                                                <td
                                                    class="p-4 text-center font-bold px-3 py-1 mt-2 inline-block rounded-lg {{ $grade->status == 'pass' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                    {{ $grade->status == 'pass' ? 'Đạt' : 'Trượt' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="7" class="p-4 text-center text-gray-500 py-8">Chưa có kết quả
                                                học tập nào rớt vào khung hiển thị.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab: Đăng ký học phần -->
                    <div x-show="activeTab === 'registration'" style="display: none;" class="space-y-6"
                        x-data="{
                            courses: [],
                            loading: true,
                            searchTerm: '',
                            showModal: false,
                            studentList: [],
                            selectedCourseName: '',
                            async fetchCourses() {
                                this.loading = true;
                                try {
                                    const res = await fetch('/sinh-vien/api/courses');
                                    this.courses = await res.json();
                                } catch (e) { console.error(e); }
                                this.loading = false;
                            },
                            async register(id) {
                                const res = await fetch('/sinh-vien/api/register', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ course_id: id })
                                });
                                const data = await res.json();
                                alert(data.message);
                                this.fetchCourses();
                            },
                            async cancel(id) {
                                if (!confirm('Bạn có chắc chắn muốn hủy đăng ký lớp học này?')) return;
                                const res = await fetch('/sinh-vien/api/cancel', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ course_id: id })
                                });
                                const data = await res.json();
                                alert(data.message);
                                this.fetchCourses();
                            },
                            async viewStudents(course) {
                                this.selectedCourseName = course.subject_name;
                                this.showModal = true;
                                this.studentList = [];
                                const res = await fetch(`/sinh-vien/api/course-students/${course.id}`);
                                this.studentList = await res.json();
                            },
                            get filteredCourses() {
                                return this.courses.filter(c =>
                                    c.subject_name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                                    c.subject_code.toLowerCase().includes(this.searchTerm.toLowerCase())
                                );
                            }
                        }" x-init="fetchCourses()">

                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl flex gap-4">
                            <div class="text-blue-500 mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-bold text-blue-800">Kỳ Đăng Ký Đang Mở:
                                    {{ $semesters->first()->semester_name ?? 'Học kỳ mới' }}</h4>
                                <p class="text-blue-600 text-sm mt-1">Hạn đăng ký đang diễn ra. Sinh viên vui lòng hoàn
                                    thành đăng ký lộ trình học tập của mình sớm nhất.</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div
                                class="p-5 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center bg-gray-50/50 gap-4">
                                <h4 class="font-bold text-gray-800">Danh sách môn học mở kỳ này</h4>
                                <div class="relative w-full md:w-64">
                                    <input type="text" x-model="searchTerm" placeholder="Tìm tên hoặc mã môn..."
                                        class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="p-0 overflow-x-auto min-h-[300px]">
                                <div x-show="loading" class="flex items-center justify-center py-20">
                                    <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>

                                <table x-show="!loading" class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                                            <th class="p-4 font-bold">Mã Học Phần</th>
                                            <th class="p-4 font-bold">Tên Môn Học</th>
                                            <th class="p-4 font-bold text-center">STC</th>
                                            <th class="p-4 font-bold text-center">Sĩ số</th>
                                            <th class="p-4 font-bold text-center">Đăng ký</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 text-gray-700 text-sm">
                                        <template x-for="course in filteredCourses" :key="course.id">
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="p-4 font-medium text-blue-600" x-text="course.subject_code">
                                                </td>
                                                <td class="p-4">
                                                    <div class="font-bold text-gray-800" x-text="course.subject_name">
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-1"
                                                        x-text="'GV: ' + course.lecturer_name"></div>
                                                </td>
                                                <td class="p-4 text-center" x-text="course.credits"></td>
                                                <td class="p-4 text-center">
                                                    <button @click="viewStudents(course)"
                                                        class="group inline-flex flex-col items-center">
                                                        <span
                                                            :class="course.is_full ? 'text-red-500 font-bold' : 'text-gray-700'"
                                                            x-text="course.current_enrollment + '/' + course.capacity"></span>
                                                        <span
                                                            class="text-[10px] text-blue-500 underline opacity-0 group-hover:opacity-100 transition-opacity">Xem
                                                            danh sách</span>
                                                    </button>
                                                </td>
                                                <td class="p-4 text-center">
                                                    <template x-if="course.is_registered">
                                                        <button @click="cancel(course.id)"
                                                            class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1.5 rounded-lg font-bold transition">Hủy
                                                            đăng ký</button>
                                                    </template>
                                                    <template x-if="!course.is_registered">
                                                        <button @click="register(course.id)" :disabled="course.is_full"
                                                            :class="course.is_full ?
                                                                'bg-gray-200 text-gray-400 cursor-not-allowed' :
                                                                'bg-blue-600 text-white hover:bg-blue-700'"
                                                            class="px-5 py-1.5 rounded-lg font-bold transition shadow-sm"
                                                            x-text="course.is_full ? 'Đã đầy' : 'Đăng ký'"></button>
                                                    </template>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="showModal"
                            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                            x-transition x-cloak>
                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden"
                                @click.away="showModal = false">
                                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">Danh sách sinh viên</h3>
                                        <p class="text-blue-600 text-xs font-bold mt-1" x-text="selectedCourseName"></p>
                                    </div>
                                    <button @click="showModal = false"
                                        class="p-2 hover:bg-gray-200 rounded-full transition-colors">
                                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="max-h-[50vh] overflow-y-auto">
                                    <table class="w-full text-left">
                                        <thead class="sticky top-0 bg-gray-50 text-gray-500 text-[10px] uppercase">
                                            <tr>
                                                <th class="p-4 pl-6">STT</th>
                                                <th class="p-4">MSSV</th>
                                                <th class="p-4 pr-6">Họ và Tên</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <template x-for="(st, index) in studentList" :key="st.student_code">
                                                <tr class="hover:bg-blue-50/50">
                                                    <td class="p-4 pl-6 text-gray-400" x-text="index + 1"></td>
                                                    <td class="p-4 font-mono font-medium text-blue-600"
                                                        x-text="st.student_code"></td>
                                                    <td class="p-4 font-bold text-gray-800 pr-6" x-text="st.full_name">
                                                    </td>
                                                </tr>
                                            </template>
                                            <template x-if="studentList.length === 0">
                                                <tr>
                                                    <td colspan="3" class="p-12 text-center text-gray-400">Đang tải
                                                        hoặc lớp trống...</td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-4 border-t border-gray-100 text-right bg-gray-50">
                                    <button @click="showModal = false"
                                        class="px-6 py-2 bg-gray-800 text-white rounded-lg font-bold">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Lịch học - Lịch thi -->
                    <div x-show="activeTab === 'schedule'" style="display: none;"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[400px]">
                        <div class="p-6 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Lịch Học Tuần 12 (06/04 - 12/04)</h3>
                            <div class="flex gap-2">
                                <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50"><svg
                                        class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg></button>
                                <button
                                    class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-sm hover:bg-gray-50">Tuần
                                    hiện tại</button>
                                <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50"><svg
                                        class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg></button>
                            </div>
                        </div>
                        <div class="p-8 text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium text-gray-600">Chức năng Lịch (Calendar) đang được xây dựng.</p>
                            <p class="text-sm mt-2">Sắp tới bạn có thể kết nối lịch học thẳng vào điện thoại qua Google
                                Calendar.</p>
                        </div>
                    </div>

                    <!-- Tab: Học phí -->
                    <div x-show="activeTab === 'tuition'" style="display: none;"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Tra Cứu Học Phí</h3>
                        </div>

                        <div
                            class="p-6 border-b border-gray-200 flex flex-col md:flex-row gap-6 justify-between items-center">
                            <div>
                                <h4 class="text-gray-500 font-bold uppercase text-sm">Tổng công nợ hiện tại</h4>
                                <p class="text-3xl font-extrabold text-red-600 mt-1">4.500.000 <span
                                        class="text-sm font-medium text-gray-500">VNĐ</span></p>
                            </div>
                            <button
                                class="w-full md:w-auto bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                                Thanh toán Online ngay
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                                        <th class="p-4 font-bold">Học Kỳ</th>
                                        <th class="p-4 font-bold">Ngày Thông Báo</th>
                                        <th class="p-4 font-bold text-right">Số Tiền (VNĐ)</th>
                                        <th class="p-4 font-bold text-center">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-4 font-medium">Học kỳ 1 - 2025-2026</td>
                                        <td class="p-4 text-gray-500">01/09/2025</td>
                                        <td class="p-4 text-right font-bold text-gray-800">4.500.000</td>
                                        <td class="p-4 text-center">
                                            <span
                                                class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Chưa
                                                nộp</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-4 font-medium">Học kỳ 2 - 2024-2025</td>
                                        <td class="p-4 text-gray-500">15/01/2025</td>
                                        <td class="p-4 text-right font-bold text-gray-800">3.800.000</td>
                                        <td class="p-4 text-center">
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Đã
                                                nộp</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
