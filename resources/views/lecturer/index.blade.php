@extends('app')

@section('content')
    <main class="bg-gray-100 min-h-screen py-8" x-data="{ activeTab: 'overview' }">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Dashboard Header -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-bold border-4 border-white shadow-md">
                        {{ substr($lecturer->full_name ?? 'G', 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $lecturer->full_name ?? 'Giảng Viên' }}</h2>
                        <p class="text-sm text-gray-500 font-medium tracking-wide">Mã GV:
                            {{ $lecturer->lecturer_code ?? 'N/A' }} | Khoa: CNTT</p>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
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
                <!-- Sidebar -->
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-24">
                        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menu Chức Năng</h3>
                        </div>
                        <nav class="p-2 space-y-1">
                            <a href="#" @click.prevent="activeTab = 'overview'"
                                :class="{ 'bg-indigo-50 text-indigo-700': activeTab === 'overview', 'text-gray-600 hover:bg-gray-50': activeTab !== 'overview' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Tổng quan
                            </a>
                            <a href="#" @click.prevent="activeTab = 'profile'"
                                :class="{ 'bg-indigo-50 text-indigo-700': activeTab === 'profile', 'text-gray-600 hover:bg-gray-50': activeTab !== 'profile' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Thông tin cá nhân
                            </a>
                            <a href="#" @click.prevent="activeTab = 'grading'"
                                :class="{ 'bg-indigo-50 text-indigo-700': activeTab === 'grading', 'text-gray-600 hover:bg-gray-50': activeTab !== 'grading' }"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                Quản lý Lớp & Sổ điểm
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Content Area -->
                <div class="w-full lg:w-3/4">
                    <!-- Tab Overview -->
                    <div x-show="activeTab === 'overview'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Tổng quan giảng dạy - {{ $latestSemester->semester_name ?? '' }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-sm font-bold text-gray-500 uppercase">Lớp phụ trách</h4>
                                    <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </span>
                                </div>
                                <div class="text-3xl font-extrabold text-gray-800">{{ $totalModules }} <span class="text-sm font-medium text-gray-500">lớp</span></div>
                            </div>
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-sm font-bold text-gray-500 uppercase">Tổng số Sinh viên</h4>
                                    <span class="bg-green-100 text-green-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </span>
                                </div>
                                <div class="text-3xl font-extrabold text-gray-800">{{ $totalStudents }} <span class="text-sm font-medium text-gray-500">SV</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Profile -->
                    <div x-show="activeTab === 'profile'" style="display: none;" class="space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6 border-b border-gray-200 bg-gray-50/50">
                                <h3 class="text-xl font-bold text-gray-800">Thông tin cá nhân & Đổi mật khẩu</h3>
                            </div>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin Giảng viên</h4>
                                    <div class="space-y-3">
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Họ và tên:</span> <span class="font-bold">{{ $lecturer->full_name ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Mã GV:</span> <span class="font-bold">{{ $lecturer->lecturer_code ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Email:</span> <span>{{ $user->email ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">SĐT:</span> <span>{{ $lecturer->phone ?? 'N/A' }}</span></p>
                                        <p><span class="font-medium text-gray-500 w-32 inline-block">Khoa:</span> <span>Công nghệ Thông tin</span></p>
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
                                            <input type="password" x-model="currentPassword" class="w-full border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu mới</label>
                                            <input type="password" x-model="newPassword" class="w-full border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu mới</label>
                                            <input type="password" x-model="confirmPassword" class="w-full border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                        </div>
                                        <div x-show="message" class="text-sm font-bold" :class="success ? 'text-green-600' : 'text-red-600'" x-text="message" x-transition></div>
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-bold transition-colors shadow-sm w-full md:w-auto">Cập nhật mật khẩu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Grading -->
                    <div x-show="activeTab === 'grading'" class="space-y-6"
                         x-data="{ 
                            classes: [], 
                            loadingClasses: false, 
                            selectedClass: '', 
                            studentCodeToAdd: '',
                            students: [], 
                            loadingStudents: false,
                            saving: false,
                            addingStudent: false,
                            async fetchClasses() {
                                this.loadingClasses = true;
                                try {
                                    const res = await fetch('/giang-vien/api/classes?semester_id={{ $latestSemester->id ?? '' }}');
                                    this.classes = await res.json();
                                    if(this.classes.length > 0) {
                                        this.selectedClass = this.classes[0].id;
                                        this.fetchStudents();
                                    }
                                } catch(e) { console.error(e); }
                                this.loadingClasses = false;
                            },
                            async fetchStudents() {
                                if(!this.selectedClass) return;
                                this.loadingStudents = true;
                                this.students = [];
                                try {
                                    const res = await fetch(`/giang-vien/api/class-students/${this.selectedClass}`);
                                    this.students = await res.json();
                                } catch(e) { console.error(e); }
                                this.loadingStudents = false;
                            },
                            async addStudent() {
                                if(!this.selectedClass || !this.studentCodeToAdd || this.addingStudent) return;
                                this.addingStudent = true;
                                try {
                                    const res = await fetch('/giang-vien/api/add-student', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                        body: JSON.stringify({
                                            course_id: this.selectedClass,
                                            student_code: this.studentCodeToAdd
                                        })
                                    });
                                    const data = await res.json();
                                    if(res.ok) {
                                        this.studentCodeToAdd = '';
                                        this.fetchStudents();
                                        alert(data.message);
                                    } else {
                                        alert(data.message || 'Lỗi thêm sinh viên!');
                                    }
                                } catch(e) { console.error(e); alert('Lỗi hệ thống!'); }
                                this.addingStudent = false;
                            },
                            async removeStudent(studentId) {
                                if(!confirm('Bạn có chắc chắn muốn xóa sinh viên này khỏi lớp? Toàn bộ điểm số của sinh viên này cũng sẽ bị xóa.')) return;
                                try {
                                    const res = await fetch('/giang-vien/api/remove-student', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                        body: JSON.stringify({
                                            course_id: this.selectedClass,
                                            student_id: studentId
                                        })
                                    });
                                    const data = await res.json();
                                    alert(data.message);
                                    this.fetchStudents();
                                } catch(e) { console.error(e); alert('Lỗi hệ thống!'); }
                            },
                            async saveGrades() {
                                if(this.saving) return;
                                this.saving = true;
                                try {
                                    const payload = {
                                        course_id: this.selectedClass,
                                        grades: this.students.map(s => ({
                                            student_id: s.student_id,
                                            DCC: s.DCC || 0,
                                            DGK: s.DGK || 0,
                                            DCK: s.DCK || 0
                                        }))
                                    };
                                    const res = await fetch('/giang-vien/api/save-grades', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                        body: JSON.stringify(payload)
                                    });
                                    const data = await res.json();
                                    alert(data.message);
                                    this.fetchStudents();
                                } catch(e) { console.error(e); alert('Lỗi hệ thống!'); }
                                this.saving = false;
                            },
                            calculateRow(st) {
                                // Clamp values between 0-10
                                ['DCC', 'DGK', 'DCK'].forEach(key => {
                                    if(st[key] > 10) st[key] = 10;
                                    if(st[key] < 0) st[key] = 0;
                                });
                                // Tính điểm TB cho lần học này (L1/L2/L3/L4 tùy đky)
                                let currentAvg = Math.round(((parseFloat(st.DCC)||0)*0.1 + (parseFloat(st.DGK)||0)*0.3 + (parseFloat(st.DCK)||0)*0.6) * 10) / 10;
                                
                                // Cập nhật trạng thái hiển thị tạm thời
                                st.status = currentAvg >= 4 ? 'Đạt' : 'Trượt';
                            }
                         }"
                         x-init="fetchClasses()"
                         x-cloak>
                        
                        <div class="bg-indigo-50 border border-indigo-200 p-4 rounded-xl flex flex-col md:flex-row items-center justify-between gap-4 w-full">
                            <div class="flex gap-4">
                                <div class="text-indigo-500 mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg></div>
                                <div>
                                    <h4 class="font-bold text-indigo-800">Sổ điểm Lớp học phần</h4>
                                    <p class="text-indigo-600 text-sm mt-1">Nhập điểm thành phần (DCC, DGK, DCK) để hệ thống tự động tính toán lần học.</p>
                                </div>
                            </div>
                            <div class="w-full md:w-auto flex flex-col sm:flex-row gap-2">
                                <select x-model="selectedClass" @change="fetchStudents()" class="w-full border-indigo-300 rounded-lg text-sm text-indigo-800 focus:ring-indigo-500 focus:border-indigo-500 bg-white font-bold md:max-w-xs shadow-sm pl-4 pr-10 py-2.5">
                                    <option value="" disabled>-- Chọn lớp học phần --</option>
                                    <template x-for="cls in classes" :key="cls.id">
                                        <option :value="cls.id" x-text="cls.subject_code + ' - ' + cls.subject_name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden relative" style="min-height: 500px;">
                            <div class="p-6 border-b border-gray-200 bg-gray-50/50">
                                <h4 class="font-bold text-gray-800 text-lg">Danh sách Sinh viên & Bảng điểm chi tiết</h4>
                            </div>
                            
                            <div class="p-0 overflow-x-auto pb-32">
                                <div x-show="loadingStudents" class="flex flex-col items-center justify-center py-32">
                                    <svg class="animate-spin h-10 w-10 text-indigo-600 mb-4" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path d="M4 12a8 8 0 018-8v8h8a8 8 0 01-16 0z" fill="currentColor" class="opacity-75"></path></svg>
                                    <span class="text-gray-500 font-medium">Đang tải sổ điểm mới nhất...</span>
                                </div>

                                <table x-show="!loadingStudents" class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-600 text-[10px] uppercase font-black tracking-widest border-b">
                                            <th class="p-4 text-center w-12">STT</th>
                                            <th class="p-4">Mã SV</th>
                                            <th class="p-4">Họ và Tên</th>
                                            <th class="p-4 text-center w-24 bg-blue-50/50">DCC (10%)</th>
                                            <th class="p-4 text-center w-24 bg-blue-50/50">DGK (30%)</th>
                                            <th class="p-4 text-center w-24 bg-blue-50/50">DCK (60%)</th>
                                            <th class="p-4 text-center border-l w-16 text-gray-400">L1</th>
                                            <th class="p-4 text-center w-16 text-gray-400">L2</th>
                                            <th class="p-4 text-center w-16 text-gray-400">L3</th>
                                            <th class="p-4 text-center w-16 text-gray-400">L4</th>
                                            <th class="p-4 text-center">TB</th>
                                            <th class="p-4 text-center">TRẠNG THÁI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 text-sm">
                                        <template x-for="(st, index) in students" :key="st.student_id">
                                            <tr class="hover:bg-indigo-50/20 transition-colors">
                                                <td class="p-4 text-center text-gray-400 font-bold" x-text="index + 1"></td>
                                                <td class="p-4 font-mono font-bold text-indigo-600" x-text="st.student_code"></td>
                                                <td class="p-4 font-black text-gray-800" x-text="st.full_name"></td>
                                                <!-- Inputs for components -->
                                                <td class="p-2 bg-blue-50/20">
                                                    <input type="number" step="0.1" x-model.number="st.DCC" :disabled="st.is_finalized" @input="calculateRow(st)" class="w-full text-center border-blue-200 rounded p-1 text-xs font-bold disabled:bg-gray-100 disabled:text-gray-400">
                                                </td>
                                                <td class="p-2 bg-blue-50/20">
                                                    <input type="number" step="0.1" x-model.number="st.DGK" :disabled="st.is_finalized" @input="calculateRow(st)" class="w-full text-center border-blue-200 rounded p-1 text-xs font-bold disabled:bg-gray-100 disabled:text-gray-400">
                                                </td>
                                                <td class="p-2 bg-blue-50/20">
                                                    <input type="number" step="0.1" x-model.number="st.DCK" :disabled="st.is_finalized" @input="calculateRow(st)" class="w-full text-center border-blue-200 rounded p-1 text-xs font-bold disabled:bg-gray-100 disabled:text-gray-400">
                                                </td>
                                                <!-- History L1-L4 -->
                                                <td class="p-4 text-center border-l text-xs text-gray-500" x-text="st.L1 || '-'"></td>
                                                <td class="p-4 text-center text-xs text-gray-500" x-text="st.L2 || '-'"></td>
                                                <td class="p-4 text-center text-xs text-gray-500" x-text="st.L3 || '-'"></td>
                                                <td class="p-4 text-center text-xs text-gray-500" x-text="st.L4 || '-'"></td>
                                                
                                                <td class="p-4 text-center">
                                                    <span class="font-black text-gray-900" x-text="st.average_score"></span>
                                                </td>
                                                <td class="p-4 text-center flex items-center justify-center gap-1">
                                                    <span :class="{
                                                         'bg-green-100 text-green-700': st.status === 'Đạt',
                                                         'bg-red-100 text-red-700': st.status === 'Trượt',
                                                         'bg-gray-100 text-gray-700': st.status === 'Chưa nhập điểm'
                                                     }" class="px-2 py-1 rounded-full text-[9px] font-black uppercase" x-text="st.status"></span>
                                                    <template x-if="st.is_finalized">
                                                        <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                                    </template>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            <!-- FLOATING ACTION BAR -->
                            <div x-show="students.length > 0" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-50 w-full max-w-md px-6" x-transition>
                                <div class="bg-indigo-600 rounded-3xl shadow-2xl p-2 flex items-center justify-between border-4 border-white">
                                    <div class="px-4">
                                        <p class="text-[10px] uppercase font-bold text-indigo-100/80">Quản lý điểm chi tiết</p>
                                        <p class="text-sm font-black text-white">Sẵn sàng lưu</p>
                                    </div>
                                    <button @click="saveGrades()" :disabled="saving" class="bg-white hover:bg-gray-100 text-indigo-700 px-8 py-4 rounded-2xl font-black shadow-lg transition-all flex items-center gap-3 active:scale-95 disabled:opacity-50">
                                        <svg x-show="!saving" class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                        <span x-text="saving ? 'ĐANG XỬ LÝ...' : 'LƯU BẢNG ĐIỂM'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
