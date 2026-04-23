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
                                            <span class="text-xs font-bold uppercase">Sáng</span>
                                            <span class="font-bold">00:00</span>
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-800 text-lg">Chức năng đang được phát triển</h5>
                                            <p class="text-gray-500 text-sm mt-1">Phòng: <strong>Null</strong> | GV: Null
                                            </p>
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
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Họ và tên:</span>
                                            <span class="font-bold">{{ $user->student->full_name ?? 'N/A' }}</span>
                                        </p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Mã SV:</span> <span
                                                class="font-bold">{{ $user->student->student_code ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Email:</span>
                                            <span>{{ $user->email ?? 'N/A' }}</span>
                                        </p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Khoa:</span>
                                            <span>{{ $user->student->schoolClass->department->department_name ?? 'N/A' }}</span>
                                        </p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Lớp:</span>
                                            <span>{{ $user->student->schoolClass->class_name ?? 'N/A' }}</span>
                                        </p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Khóa học:</span> <span
                                                class="text-blue-600 font-bold">Khóa
                                                {{ $user->student->schoolClass->academicBatch->start_year ?? 'N/A' }}</span>
                                        </p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Niên khóa:</span>
                                            <span>{{ $user->student->schoolClass->academicBatch->range ?? 'N/A' }}</span>
                                        </p>
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
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu hiện
                                                tại</label>
                                            <input type="password" x-model="currentPassword"
                                                class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu
                                                mới</label>
                                            <input type="password" x-model="newPassword"
                                                class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu
                                                mới</label>
                                            <input type="password" x-model="confirmPassword"
                                                class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div x-show="message" class="text-sm font-bold"
                                            :class="success ? 'text-green-600' : 'text-red-600'" x-text="message"
                                            x-transition></div>
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition-colors shadow-sm w-full md:w-auto">Cập
                                            nhật mật khẩu</button>
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
                                                <td class="p-4 text-center text-sm">
                                                    <span class="text-gray-400">CC:</span> {{ $grade->attendance_score }}
                                                </td>
                                                <td class="p-4 text-center text-sm">
                                                    <div class="flex flex-col">
                                                        @if($grade->L1) <span><span class="text-gray-400">L1:</span> {{ $grade->L1 }}</span> @endif
                                                        @if($grade->L2) <span><span class="text-gray-400">L2:</span> {{ $grade->L2 }}</span> @endif
                                                    </div>
                                                </td>
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
                            categories: { first_time: [], retake: [], improvement: [], ongoing: [] },
                            currentSchedules: [],
                            loading: true,
                            errorMessage: '',
                            selectedSubject: null,
                            showScheduleSelection: false,
                            async fetchCategories() {
                                this.loading = true;
                                this.errorMessage = '';
                                try {
                                    const res = await fetch('/sinh-vien/api/courses');
                                    const data = await res.json();
                                    if (data.error) {
                                        this.errorMessage = data.error;
                                    } else {
                                        this.categories = data.categories;
                                        this.currentSchedules = data.current_schedules;
                                    }
                                } catch (e) { 
                                    this.errorMessage = 'Lỗi kết nối máy chủ. Vui lòng thử lại.';
                                    console.error(e); 
                                }
                                this.loading = false;
                            },
                            async register(moduleId) {
                                if (!confirm('Xác nhận đăng ký lớp học này?')) return;
                                const res = await fetch('/sinh-vien/api/register', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ course_id: moduleId })
                                });
                                const data = await res.json();
                                alert(data.message);
                                if (res.ok) {
                                    this.showScheduleSelection = false;
                                    this.fetchCategories();
                                }
                            },
                            async cancel(moduleId) {
                                if (!confirm('Bạn có chắc chắn muốn hủy đăng ký lớp học này?')) return;
                                const res = await fetch('/sinh-vien/api/cancel', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ course_id: moduleId })
                                });
                                const data = await res.json();
                                alert(data.message);
                                if (res.ok) {
                                    this.showScheduleSelection = false;
                                    this.fetchCategories();
                                }
                            },
                            openSelection(subject) {
                                if (!subject.has_modules) {
                                    alert('Môn học này hiện chưa có lớp học phần nào được mở trong kỳ này.');
                                    return;
                                }
                                this.selectedSubject = subject;
                                this.showScheduleSelection = true;
                            }
                        }" x-init="fetchCategories()">

                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl flex gap-4">
                            <div class="text-blue-500 mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg></div>
                            <div>
                                <h4 class="font-bold text-blue-800">Kỳ Đăng Ký Học Phần</h4>
                                <p class="text-blue-600 text-sm mt-1">Danh sách các môn học thuộc khoa của bạn. Vui lòng kiểm tra kỹ lịch học trước khi đăng ký.</p>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div x-show="errorMessage" class="bg-red-50 border border-red-200 p-6 rounded-2xl text-center shadow-sm" style="display: none;">
                            <div class="text-red-500 mb-2 flex justify-center"><svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                            <h4 class="font-bold text-red-800 text-lg">Không thể tải dữ liệu</h4>
                            <p class="text-red-600 mt-1" x-text="errorMessage"></p>
                            <button @click="fetchCategories()" class="mt-4 bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">Thử lại</button>
                        </div>

                        <div x-show="!showScheduleSelection && !errorMessage" class="space-y-8">
                            <template x-for="(list, type) in categories" :key="type">
                                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-4 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                                        <h4 class="font-bold text-gray-800 uppercase text-sm" x-text="type === 'first_time' ? '1. Danh sách học phần đăng ký học lần đầu' : (type === 'retake' ? '2. Danh sách học phần đăng ký học lại' : (type === 'improvement' ? '3. Danh sách học phần đăng ký học cải thiện' : '4. Danh sách học phần đang học / Thiếu điểm'))"></h4>
                                        <span class="text-xs text-gray-400" x-text="list.length + ' môn'"></span>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-50 text-gray-500 text-[10px] uppercase tracking-wider">
                                                    <th class="p-4 font-bold">#</th>
                                                    <th class="p-4 font-bold">Mã HP</th>
                                                    <th class="p-4 font-bold">Tên học phần</th>
                                                    <th class="p-4 font-bold text-center">STC</th>
                                                    <th class="p-4 font-bold text-center">DCC</th>
                                                    <th class="p-4 font-bold text-center">DGK</th>
                                                    <th class="p-4 font-bold text-center">DCK</th>
                                                    <th class="p-4 font-bold text-center">Tổng kết</th>
                                                    <th class="p-4 font-bold text-center">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 text-sm">
                                                <template x-for="(subject, index) in list" :key="subject.subject_id">
                                                    <tr class="hover:bg-blue-50/30 transition-colors">
                                                        <td class="p-4 text-gray-400" x-text="index + 1"></td>
                                                        <td class="p-4 font-medium text-blue-600" x-text="subject.subject_code"></td>
                                                        <td class="p-4 font-bold text-gray-800" x-text="subject.subject_name"></td>
                                                        <td class="p-4 text-center" x-text="subject.credits"></td>
                                                        <td class="p-4 text-center" x-text="subject.DCC ?? '-'"></td>
                                                        <td class="p-4 text-center" x-text="subject.DGK ?? '-'"></td>
                                                        <td class="p-4 text-center" x-text="subject.DCK ?? '-'"></td>
                                                        <td class="p-4 text-center font-bold" x-text="subject.average_score ?? '-'"></td>
                                                        <td class="p-4 text-center">
                                                            <template x-if="subject.has_modules">
                                                                <button @click="openSelection(subject)" class="bg-blue-600 text-white px-4 py-1.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-sm">Đăng ký</button>
                                                            </template>
                                                            <template x-if="!subject.has_modules">
                                                                <span class="bg-gray-100 text-gray-400 px-3 py-1 rounded text-xs font-bold">Chưa mở lớp</span>
                                                            </template>
                                                            <template x-if="subject.is_ongoing">
                                                                <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded text-xs font-bold ml-1">Đang học</span>
                                                            </template>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template x-if="list.length === 0">
                                                    <tr>
                                                        <td colspan="9" class="p-8 text-center text-gray-400 italic">Không có môn học nào trong danh mục này.</td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </template>
                            <div x-show="loading" class="text-center py-20 text-gray-400">Đang tải dữ liệu đăng ký...</div>
                        </div>

                        <!-- View: Chọn thời khóa biểu -->
                        <div x-show="showScheduleSelection" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden" style="display: none;">
                            <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800" x-text="'Chọn lớp cho học phần: ' + selectedSubject?.subject_name"></h3>
                                    <p class="text-sm text-gray-500 mt-1">Vui lòng so sánh lịch học với các môn đã đăng ký để tránh trùng lịch.</p>
                                </div>
                                <button @click="showScheduleSelection = false" class="text-gray-500 hover:text-gray-800 font-bold flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                    Quay lại
                                </button>
                            </div>
                            
                            <div class="p-6 space-y-8">
                                <!-- So sánh lịch học -->
                                <div x-show="currentSchedules.length > 0">
                                    <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Thời khóa biểu các môn đã đăng ký (Để so sánh)
                                    </h4>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left border-collapse bg-orange-50/30">
                                            <thead>
                                                <tr class="bg-orange-100 text-orange-800 text-[10px] uppercase">
                                                    <th class="p-2 border border-orange-200">Học phần</th>
                                                    <th class="p-2 border border-orange-200">Thứ 2</th>
                                                    <th class="p-2 border border-orange-200">Thứ 3</th>
                                                    <th class="p-2 border border-orange-200">Thứ 4</th>
                                                    <th class="p-2 border border-orange-200">Thứ 5</th>
                                                    <th class="p-2 border border-orange-200">Thứ 6</th>
                                                    <th class="p-2 border border-orange-200">Thứ 7</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-xs">
                                                <template x-for="s in currentSchedules" :key="s.subject_name">
                                                    <tr>
                                                        <td class="p-2 border border-orange-100 font-bold" x-text="s.subject_name"></td>
                                                        <td class="p-2 border border-orange-100" x-text="s.monday || '-'"></td>
                                                        <td class="p-2 border border-orange-100" x-text="s.tuesday || '-'"></td>
                                                        <td class="p-2 border border-orange-100" x-text="s.wednesday || '-'"></td>
                                                        <td class="p-2 border border-orange-100" x-text="s.thursday || '-'"></td>
                                                        <td class="p-2 border border-orange-100" x-text="s.friday || '-'"></td>
                                                        <td class="p-2 border border-orange-100" x-text="s.saturday || '-'"></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Danh sách lớp mở -->
                                <div>
                                    <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Danh sách các lớp mở cho môn này
                                    </h4>
                                    <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse border border-gray-100">
                                        <thead>
                                            <tr class="bg-gray-800 text-white text-xs uppercase">
                                                <th class="p-3 border border-gray-700">#</th>
                                                <th class="p-3 border border-gray-700">Lớp HP</th>
                                                <th class="p-3 border border-gray-700">Thứ 2</th>
                                                <th class="p-3 border border-gray-700">Thứ 3</th>
                                                <th class="p-3 border border-gray-700">Thứ 4</th>
                                                <th class="p-3 border border-gray-700">Thứ 5</th>
                                                <th class="p-3 border border-gray-700">Thứ 6</th>
                                                <th class="p-3 border border-gray-700">Thứ 7</th>
                                                <th class="p-3 border border-gray-700">Giảng viên</th>
                                                <th class="p-3 border border-gray-700 text-center">Sĩ số</th>
                                                <th class="p-3 border border-gray-700 text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                            <template x-for="(m, idx) in selectedSubject?.modules" :key="m.id">
                                                <tr :class="m.is_registered ? 'bg-green-50' : 'hover:bg-blue-50/50'">
                                                    <td class="p-3 border border-gray-100" x-text="idx + 1"></td>
                                                    <td class="p-3 border border-gray-100 font-bold text-blue-700" x-text="'Lớp ' + (idx + 1)"></td>
                                                    <td class="p-3 border border-gray-100 text-[11px]" x-text="m.schedule?.monday || '-'"></td>
                                                    <td class="p-3 border border-gray-100 text-[11px]" x-text="m.schedule?.tuesday || '-'"></td>
                                                    <td class="p-3 border border-gray-100 text-[11px]" x-text="m.schedule?.wednesday || '-'"></td>
                                                    <td class="p-3 border border-gray-100 text-[11px]" x-text="m.schedule?.thursday || '-'"></td>
                                                    <td class="p-3 border border-gray-100 text-[11px]" x-text="m.schedule?.friday || '-'"></td>
                                                    <td class="p-3 border border-gray-100 text-[11px]" x-text="m.schedule?.saturday || '-'"></td>
                                                    <td class="p-3 border border-gray-100 font-medium" x-text="m.lecturer"></td>
                                                    <td class="p-3 border border-gray-100 text-center" x-text="m.current + '/' + m.capacity"></td>
                                                    <td class="p-3 border border-gray-100 text-center">
                                                        <template x-if="m.is_registered">
                                                            <button @click="cancel(m.id)" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-bold shadow-sm">Hủy</button>
                                                        </template>
                                                        <template x-if="!m.is_registered">
                                                            <button @click="register(m.id)" class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold shadow-sm" :disabled="m.current >= m.capacity">Chọn</button>
                                                        </template>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Lịch học - Lịch thi -->
                    <div x-show="activeTab === 'schedule'" style="display: none;"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[400px]">
                        <div class="p-6 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Lịch học dành cho bạn</h3>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span class="bg-blue-600 w-2 h-2 rounded-full"></span>
                                <span>Khóa {{ $user->student->schoolClass->academicBatch->start_year ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-100 mb-8">
                            @forelse($schedules as $schedule)
                                <div class="p-6 hover:bg-gray-50/80 transition-colors group">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-1">
                                                <h4 class="text-lg font-bold text-gray-800 group-hover:text-blue-700 transition-colors">
                                                    {{ $schedule->courseModule->subject->subject_name ?? 'N/A' }}
                                                </h4>
                                                <span class="bg-blue-100 text-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Lịch của bạn</span>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3 text-sm">
                                                @if($schedule->monday) <p class="text-gray-600"><strong>Thứ 2:</strong> {{ $schedule->monday }}</p> @endif
                                                @if($schedule->tuesday) <p class="text-gray-600"><strong>Thứ 3:</strong> {{ $schedule->tuesday }}</p> @endif
                                                @if($schedule->wednesday) <p class="text-gray-600"><strong>Thứ 4:</strong> {{ $schedule->wednesday }}</p> @endif
                                                @if($schedule->thursday) <p class="text-gray-600"><strong>Thứ 5:</strong> {{ $schedule->thursday }}</p> @endif
                                                @if($schedule->friday) <p class="text-gray-600"><strong>Thứ 6:</strong> {{ $schedule->friday }}</p> @endif
                                                @if($schedule->saturday) <p class="text-gray-600"><strong>Thứ 7:</strong> {{ $schedule->saturday }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center text-gray-400">Bạn chưa có lịch học nào (Vui lòng đăng ký môn học).</div>
                            @endforelse
                        </div>

                        <!-- Section: #Khác -->
                        <div class="p-6 border-b border-t border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-500">#Lịch các môn khác</h3>
                        </div>

                        <div class="divide-y divide-gray-100 bg-gray-50/30">
                            @forelse($otherSchedules as $schedule)
                                <div class="p-5 hover:bg-white transition-colors group">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-1">
                                                <h4 class="text-base font-bold text-gray-600 group-hover:text-gray-900 transition-colors">
                                                    {{ $schedule->courseModule->subject->subject_name ?? 'N/A' }}
                                                </h4>
                                                <span class="bg-gray-200 text-gray-500 text-[9px] font-bold px-2 py-0.5 rounded uppercase">
                                                    GV: {{ $schedule->courseModule->lecturer->full_name ?? 'N/A' }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-400 mt-1 italic">
                                                Lịch học dự kiến: 
                                                {{ collect([$schedule->monday, $schedule->tuesday, $schedule->wednesday, $schedule->thursday, $schedule->friday, $schedule->saturday])->filter()->first() }}...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-10 text-center text-gray-400 text-sm italic">Không có lịch học nào khác.</div>
                            @endforelse
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
